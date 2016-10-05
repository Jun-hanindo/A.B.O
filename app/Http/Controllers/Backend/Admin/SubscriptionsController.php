<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Subscription;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;

class SubscriptionsController extends BaseController
{

    public function __construct(Subscription $model)
    {
        parent::__construct($model);

    }
    
    /**
     * @return Response
     */
    public function index()
    {
        $trail = 'List Subscription';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        return view('backend.admin.subscription.index');
    }

    /**
     * Show list for venue
     * 
     * @return Response
     */
    public function datatables(Request $req)
    {
        $param = $req->all();
        $start = $param['start_date'];
        $end = $param['end_date'];

        return datatables($this->model->datatables($start, $end))
            ->editColumn('created_at', function($data){
                $date = short_text_date_time($data->created_at);
                return $date;
            })
            ->editColumn('action', function ($subscription) {
                $showUrl = route('admin-show-subscription',$subscription->id);
                //$editUrl = route('admin-edit-subscription',$subscription->id);
                $action =  '<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$subscription->id.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                // $action =  '<a href="'.$editUrl.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                //         &nbsp;<a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$subscription->id.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>
                //         &nbsp;<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$subscription->id.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                return $action;
            })
            ->make(true);
    }

    public function eventDatatables(Request $req){
        $param = $req->all();
        $subscription_id = $param['subscription_id'];
        return datatables($this->model->eventDatatables($subscription_id))
            ->make(true);
    }



    /**
     * Show form for edit subscription.
     * paths url    : admin/subscription/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        try{
            $result['data'] = $this->model->findSubscriptionByID($id);
            
            $trail = 'Subscription view';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('backend.admin.subscription.view', $result);

        //} else {
        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
            
            return redirect()->route('admin-index-subscription');

        }
    }

    /**
     * Delete data venue.
     * paths url    : admin/venue/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    // public function destroy($id)
    // {
    //     try{
    //         $data = $this->model->deleteByID($id);
    //     //if(!empty($data)) {
    //         flash()->success(trans('general.delete_success'));

    //         $log['user_id'] = $this->currentUser->id;
    //         $log['description'] = 'Subscriber "'.$data->name.'" was deleted';
    //         $insertLog = new LogActivity();
    //         $insertLog->insertLogActivity($log);

    //         return redirect()->route('admin-index-subscription');

    //     //} else {
    //     } catch (\Exception $e) {

    //         flash()->error(trans('general.data_not_found'));

    //         $log['user_id'] = $this->currentUser->id;
    //         $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
    //         $insertLog = new LogActivity();
    //         $insertLog->insertLogActivity($log);

    //         return redirect()->route('admin-index-subscription');

    //     }
    // }
}
