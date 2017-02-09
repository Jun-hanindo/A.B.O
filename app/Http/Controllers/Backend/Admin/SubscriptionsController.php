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
        $trail['desc'] = 'List Subscription';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
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
            ->editColumn('confirmed_at', function($data){
                if($data->confirmed_at != null){
                    $date = short_text_date_time($data->confirmed_at);
                }else{
                    $date = '';
                }
                return $date;
            })
            ->editColumn('action', function ($subscription) {
                $showUrl = route('admin-show-subscription',$subscription->id);
                $action =  '<a href="'.$showUrl.'" class="btn btn-info btn-xs actShow" title="Show Detail" data-id="'.$subscription->id.'" data-button="show"><i class="fa fa-search fa-fw"></i></a>';
                return $action;
            })
            ->make(true);
    }

    public function eventDatatables(Request $req)
    {
        $param = $req->all();
        $subscription_id = $param['subscription_id'];
        return datatables($this->model->eventDatatables($subscription_id))
            ->make(true);
    }


    /**
     * Show subscription detail page.
     * paths url    : admin/subscription/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        try{
            $result['data'] = $this->model->findSubscriptionByID($id);
            
            $trail['desc'] = 'Subscription view';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

            return view('backend.admin.subscription.view', $result);

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            return redirect()->route('admin-index-subscription');

        }
    }
}
