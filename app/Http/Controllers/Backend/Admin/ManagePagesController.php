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

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

        }
        
        if(!empty($page)){
            $data['content'] = $page->content;
            $data['responsive_content'] = $page->responsive_content;
            $data['status'] = $page->status;
        }else{
            $data['content'] = '';
            $data['responsive_content'] = '';
            $data['status'] = '';
        }
        $data['slug'] = $slug;
        if($slug == 'contact-us'){
            $data['title'] = trans('backend/general.contact_us_page');
        }elseif($slug == 'terms-and-conditions'){
            $data['title'] = trans('backend/general.terms_and_conditions_page');
        }elseif($slug == 'terms-of-website-use'){
            $data['title'] = trans('backend/general.terms_of_website_use_page');
        }elseif($slug == 'terms-of-ticket-sales'){
            $data['title'] = trans('backend/general.terms_of_ticket_sales_page');
        }elseif($slug == 'privacy-policy'){
            $data['title'] = trans('backend/general.privacy_policy_page');
        }elseif($slug == 'about-us'){
            $data['title'] = trans('backend/general.about_us_page');
        }elseif($slug == 'careers'){
            $data['title'] = trans('backend/general.career_page');
        }elseif($slug == 'faq'){
            $data['title'] = trans('backend/general.faq_page');
        }elseif($slug == 'how-to-buy-tickets'){
            $data['title'] = trans('backend/general.how_to_buy_tickets_page');
        }else{
            $data['title'] = trans('backend/general.page_management');
        }
        
        $trail['desc'] = $data['title'];
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        $data['setting'] = $this->setting;

        return view('backend.admin.manage_page.form', $data);
    }

    public function storeUpdate(ManagePageRequest $req, $slug)
    {
        $param = $req->all();
        
        try{
            if($req->ajax() && $param['status'] == 'draft'){

                $user_id = $this->currentUser->id;
                $updateData = $this->model->updateManagePage($param, $slug, $user_id);
                $this->model->updateStatusToDraft($param, $slug);
            //if(!empty($updateData)) {

                //$log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Page "'.$updateData->title.'" was updated';
                $insertLog = new LogActivity();
                $insertLog->insertNewLogActivity($log);


                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
                ],200);
            }elseif($req->ajax() && $param['status'] == 'preview'){
                \Session::put('preview_'.$slug, $param);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.update_success')
                ],200);
            }else{

                $user_id = $this->currentUser->id;
                $updateData = $this->model->updateManagePage($param, $slug, $user_id);
            //if(!empty($updateData)) {

                //$log['user_id'] = $this->currentUser->id;
                $log['description'] = 'Page "'.$updateData->title.'" was updated';
                $insertLog = new LogActivity();
                $insertLog->insertNewLogActivity($log);

                flash()->success($updateData->title.' '.trans('general.update_success'));

                return redirect()->route('admin-manage-page', $slug);

            }

        //} else {
        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

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
