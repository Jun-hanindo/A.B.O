<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\TixtrackAccount;
use App\Models\TixtrackCustomer;
use App\Models\TixtrackOrder;
use App\Models\Event;
use App\Http\Controllers\Backend\Admin\BaseController;
use File;
use Excel;
use DB;
//use GuzzleHttp\Cookie\CookieJar;
//use GuzzleHttp\Cookie\CookieJarInterface;

class ReportsController extends BaseController
{
    // public function __construct(LogActivity $model)
    // {
    //     parent::__construct($model);
    // }

    public function cookie(){
        if (\Session::has('ASPXAUTH')) {
            $cookie = \Session::get('ASPXAUTH'); 
            return $cookie;
        }else{
            return redirect()->route('admin-tixtrack-login');
        }
    }
    
    /**
     * @return Response
     */
    public function index()
    {
        $trail = 'List Report Tixtrack';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        $accountModel = new TixtrackAccount();
        if (\Session::has('AccountID')) {
            $AccountID = \Session::get('AccountID'); 
        }else{
            $AccountID = '';
        }
        $data['account_selected'] = $AccountID;
        $data['account'] = $accountModel->getTixtrackAccount();
        return view('backend.admin.tixtrack.index', $data);
    }

    public function datatablesMember()
    {
        $modelMember = new TixtrackCustomer();
        return datatables($modelMember->datatables())
            ->addColumn('action', function ($member) {
                
            })
            // ->filterColumn('post_by', function($query, $keyword) {
            //     $query->whereRaw("LOWER(CAST(CONCAT(users.first_name, ' ', users.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
            // })
            ->make(true);
    }

    public function datatablesTransaction()
    {
        $modelTransaction = new TixtrackOrder();
        return datatables($modelTransaction->datatables())
            ->addColumn('action', function ($transaction) {
                
            })
            ->filterColumn('customer', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(CONCAT(tixtrack_orders.first_name, ' ', tixtrack_orders.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    public function report(Request $req){
        $param = $req->all();
        $modelOrder = new TixtrackOrder();
        if(!empty($param)){
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $sample1 = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);

            $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
            $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
            $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
            $data['dates'] = $modelOrder->getDate($event_id, $start_date, $end_date);
            $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
            $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
            //$data['datePros'] = $modelOrder->getPromotionByEvent($event_id, $start_date, $end_date);
            $data['countCat'] = count($data['categories']);
            $data['countPay'] = count($data['payments']);
            $data['countPro'] = count($data['promotions']);

            $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
            $data['totalPays'] = $modelOrder->totalPaymentEvent($event_id, $start_date, $end_date);
            $data['totalPros'] = $modelOrder->totalPromotionEvent($event_id, $start_date, $end_date);

            $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);
            $data['allTotalPro'] = $modelOrder->allTotalPromotion($event_id, $start_date, $end_date);

            $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id);
            $data['allSale'] = $modelOrder->getAllSale($event_id);
            $data['countAllCat'] = count($data['allCategories']);

            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['event_id'] = $event_id;
            $data['modelOrder'] = $modelOrder;
        }
        $data['events'] = Event::select('id', 'event_id_tixtrack', 'title')->orderBy('title', 'asc')->get();
        return view('backend.admin.tixtrack.report', $data);
    }
}
