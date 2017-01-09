<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\EventPromotion;
use App\Models\Event;
use App\Models\LogActivity;
use App\Http\Controllers\Backend\Admin\BaseController;

class EventPromotionsController extends BaseController
{

    public function __construct(EventPromotion $model)
    {
        parent::__construct($model);

    }

    public function updateSortOrder(Request $req){
        $param = $req->all();

        try{
            $updateData = $this->model->updateCurrentSortOrder($param);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Sort Order '.trans('general.update_success')
            ],200);
        
        //} else {
        } catch (\Exception $e) {

            //$log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }

}
