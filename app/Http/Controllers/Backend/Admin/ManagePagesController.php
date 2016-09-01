<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ManagePage;
use App\Models\LogActivity;
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
    public function index($slug)
    {
        $page = $this->model->findPageBySlug($slug);
        if(!empty($page)){
            $data['content'] = $page->content;
        }else{
            $data['content'] = '';
        }
        $data['slug'] = $slug;
        if($slug == 'contact-us'){
            $data['title'] = trans('general.contact_us');
        }elseif($slug == 'terms-and-conditions'){
            $data['title'] = trans('general.terms_and_conditions');
        }elseif($slug == 'privacy-policy'){
            $data['title'] = trans('general.privacy_policy');
        }elseif($slug == 'about-us'){
            $data['title'] = trans('general.about_us');
        }elseif($slug == 'careers'){
            $data['title'] = trans('general.career');
        }elseif($slug == 'faq'){
            $data['title'] = trans('general.faq');
        }
        return view('backend.admin.manage_page.form', $data);
    }

    public function storeUpdate(ManagePageRequest $req, $slug){
        $param = $req->all();
        $user_id = $this->currentUser->id;
        $updateData = $this->model->updateManagePage($param, $slug, $user_id);
        if(!empty($updateData)) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = 'Page "'.$updateData->title.'" was updated';
            $log['ip_address'] = $req->ip();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->success($updateData->title.' '.trans('general.update_success'));
            return redirect()->route('admin-manage-page', $slug);

        } else {
            flash()->error(trans('general.update_error'));
            return redirect()->route('admin-manage-page', $slug)->withInput();

        }
    }
}
