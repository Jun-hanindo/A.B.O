<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ManagePage;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\manage_page\ManagePageRequest;

class ManagePagesController extends BaseController
{

    public function __construct(ManagePage $model)
    {
        parent::__construct($model);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req, $slug)
    {
        try
        {
            $page = $this->model->findPageBySlug($slug);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

        }
        
        if(!empty($page)){
            $data['content'] = $page->content;
            $data['status'] = $page->status;
        }else{
            $data['content'] = '';
            $data['status'] = '';
        }
        $data['slug'] = $slug;
        if($slug == 'contact-us'){
            $data['title'] = trans('general.contact_us_page');
        }elseif($slug == 'terms-and-conditions'){
            $data['title'] = trans('general.terms_and_conditions_page');
        }elseif($slug == 'privacy-policy'){
            $data['title'] = trans('general.privacy_policy_page');
        }elseif($slug == 'about-us'){
            $data['title'] = trans('general.about_us_page');
        }elseif($slug == 'careers'){
            $data['title'] = trans('general.career_page');
        }elseif($slug == 'faq'){
            $data['title'] = trans('general.faq_page');
        }elseif($slug == 'ways-to-buy-tickets'){
            $data['title'] = trans('general.ways_to_buy_tickets_page');
        }else{
            $data['title'] = trans('general.page_management');
        }
        
        $trail = $data['title'];
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        $data['setting'] = $this->setting;

        return view('backend.admin.manage_page.form', $data);
    }

    public function storeUpdate(ManagePageRequest $req, $slug)
    {
        $param = $req->all();
        
        try{

            $user_id = $this->currentUser->id;
            $updateData = $this->model->updateManagePage($param, $slug, $user_id);
        //if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Page "'.$updateData->title.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            if($req->ajax() && $param['status'] == 'draft'){
                $this->model->updateStatusToDraft($param, $slug);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);
            }else{

                flash()->success($updateData->title.' '.trans('general.update_success'));

                return redirect()->route('admin-manage-page', $slug);

            }

        //} else {
        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            if($req->ajax()){
                
                return response()->json([
                    'code' => 400,
                    'status' => 'success',
                    'message' => trans('general.update_error')
                ],400);
            }
            
            return redirect()->route('admin-manage-page', $slug)->withInput();

        }
    }
}
