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
use Storage;
use PDF;
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

        $dropdown = $accountModel->dropdown();
        $drop = [];
        foreach ($dropdown as $key => $value) {
            $drop[0] = 'All';
            $drop[$value->id] = $value->name;
        }

        $data['dropdown'] = $drop;

        return view('backend.admin.tixtrack.index', $data);
    }

    public function datatablesMember(Request $req)
    {
        $modelMember = new TixtrackCustomer();
        $param = $req->all();
        $account = $param['account_id'];
        if($account == 0){
            $model = $modelMember->datatables();
        }else{
            $model = $modelMember->datatablesAccount($account);
        }
        return datatables($model)
            ->addColumn('action', function ($member) {
                
            })
            ->make(true);
    }

    public function datatablesTransaction(Request $req)
    {
        $modelTransaction = new TixtrackOrder();
        $param = $req->all();
        $account = $param['account_id'];
        if($account == 0){
            $model = $modelTransaction->datatables();
        }else{
            $model = $modelTransaction->datatablesAccount($account);
        }
        return datatables($model)
            ->addColumn('action', function ($transaction) {
                
            })
            ->filterColumn('customer', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(CONCAT(tixtrack_orders.first_name, ' ', tixtrack_orders.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    public function report(Request $req){
        try{
            $param = $req->all();
            $modelOrder = new TixtrackOrder();
            $modelEvent = new Event();
            if(!empty($param)){
                $event_id = $param['event'];
                $start_date = $param['start_date'];
                $end_date = $param['end_date'];
                $sample1 = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);

                $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
                $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
                //$data['dates'] = $modelOrder->getDate($event_id, $start_date, $end_date);
                $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
                $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
                $data['datePros'] = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);

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
                $data['event'] = $modelEvent->getEventByTixtrack($event_id);

                $cat = $data['dateCats'];
                //dd($cat[0]);
                foreach ($cat as $key => $value) {
                    $labels[] = [
                        $value->local_created.'|'.$value->event_date
                    ];
                    // $labels[$value->local_created.'|'.$value->event_date] = [
                    //     'Full Amount:',
                    //     'Discounted Amt:',
                    //     'Quantity:',

                    // ];
                }

                //dd($labels);


            }
            $data['events'] = Event::select('id', 'event_id_tixtrack', 'title')->orderBy('title', 'asc')->get();
            return view('backend.admin.tixtrack.report', $data);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-report-tixtrack');
        
        }
    }

    public function tes_reportExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-Category-'.date('Y-m-d-H-i-s').'.pdf';
            //ob_end_clean();
            //ob_start();

            //Excel::create($filename, function($excel) use ($param) {

                //$excel->sheet('REPORT BY CATEGORY', function($sheet) use ($param) {
                    $event_id = $param['event'];
                    $start_date = $param['start_date'];
                    $end_date = $param['end_date'];
                    $modelOrder = new TixtrackOrder();
                    $modelEvent = new Event();
                    $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                    $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
                    $data['countCat'] = count($data['categories']);
                    $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
                    $data['event'] = $modelEvent->getEventByTixtrack($event_id);
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['event_id'] = $event_id;
                    $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);

                    $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
                    $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
                    $data['countPay'] = count($data['payments']);
                    $data['totalPays'] = $modelOrder->totalPaymentEvent($event_id, $start_date, $end_date);

                    $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
                    $data['datePros'] = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);
                    $data['countPro'] = count($data['promotions']);
                    $data['totalPros'] = $modelOrder->totalPromotionEvent($event_id, $start_date, $end_date);
                    $data['allTotalPro'] = $modelOrder->allTotalPromotion($event_id, $start_date, $end_date);

                    $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id);
                    $data['allSale'] = $modelOrder->getAllSale($event_id);
                    $data['countAllCat'] = count($data['allCategories']);

                    $data['modelOrder'] = $modelOrder;
                    //$pdf = PDF::loadView('backend.admin.tixtrack.export_report.pdf_category', $data);
                    //return $pdf->download($filename);
                    //$sheet->setAutoSize(false);

                    //$sheet->loadView('backend.admin.tixtrack.export_report.excel_category',$data);

                //});

            //})->export('xlsx');
        }

            return view('backend.admin.tixtrack.export_report.pdf', $data);
    }

    public function exportCategoryToExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-Category-'.date('Y-m-d-H-i-s');
            ob_end_clean();
            ob_start();

            Excel::create($filename, function($excel) use ($param) {

                $excel->sheet('REPORT BY CATEGORY', function($sheet) use ($param) {
                    $event_id = $param['event'];
                    $start_date = $param['start_date'];
                    $end_date = $param['end_date'];
                    $modelOrder = new TixtrackOrder();
                    $modelEvent = new Event();
                    $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                    $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
                    $data['countCat'] = count($data['categories']);
                    $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
                    $data['event'] = $modelEvent->getEventByTixtrack($event_id);
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['event_id'] = $event_id;
                    $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);
                    $sheet->setAutoSize(false);

                    $sheet->loadView('backend.admin.tixtrack.export_report.excel_category',$data);

                });

            })->export('xlsx');
        }
    }

    public function exportPaymentToExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-Payment-'.date('Y-m-d-H-i-s');
            ob_end_clean();
            ob_start();

            Excel::create($filename, function($excel) use ($param) {

                $excel->sheet('REPORT BY PAYMENT', function($sheet) use ($param) {
                    $event_id = $param['event'];
                    $start_date = $param['start_date'];
                    $end_date = $param['end_date'];
                    $modelOrder = new TixtrackOrder();
                    $modelEvent = new Event();
                    $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
                    $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
                    $data['countPay'] = count($data['payments']);
                    $data['totalPays'] = $modelOrder->totalPaymentEvent($event_id, $start_date, $end_date);
                    $data['event'] = $modelEvent->getEventByTixtrack($event_id);
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['event_id'] = $event_id;
                    $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);
                    $sheet->setAutoSize(false);

                    $sheet->loadView('backend.admin.tixtrack.export_report.excel_payment',$data);

                });

            })->export('xlsx');
        }
    }

    public function exportPromotionToExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-Promotion-'.date('Y-m-d-H-i-s');
            ob_end_clean();
            ob_start();

            Excel::create($filename, function($excel) use ($param) {

                $excel->sheet('REPORT BY PROMOTION', function($sheet) use ($param) {
                    $event_id = $param['event'];
                    $start_date = $param['start_date'];
                    $end_date = $param['end_date'];
                    $modelOrder = new TixtrackOrder();
                    $modelEvent = new Event();
                    $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
                    $data['datePros'] = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);
                    $data['countPro'] = count($data['promotions']);
                    $data['totalPros'] = $modelOrder->totalPromotionEvent($event_id, $start_date, $end_date);
                    $data['event'] = $modelEvent->getEventByTixtrack($event_id);
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['event_id'] = $event_id;
                    $data['allTotalPro'] = $modelOrder->allTotalPromotion($event_id, $start_date, $end_date);
                    $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);
                    $data['modelOrder'] = $modelOrder;
                    $sheet->setAutoSize(false);

                    $sheet->loadView('backend.admin.tixtrack.export_report.excel_promotion',$data);

                });

            })->export('xlsx');
        }
    }


    
    public function exportReportToExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-Category-'.date('Y-m-d-H-i-s');
            ob_end_clean();
            ob_start();

            Excel::create($filename, function($excel) use ($param) {

                $excel->sheet('REPORT BY CATEGORY', function($sheet) use ($param) {
                    $event_id = $param['event'];
                    $start_date = $param['start_date'];
                    $end_date = $param['end_date'];
                    $modelOrder = new TixtrackOrder();
                    $modelEvent = new Event();
                    $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                    $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
                    $data['countCat'] = count($data['categories']);
                    $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
                    $data['event'] = $modelEvent->getEventByTixtrack($event_id);
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['event_id'] = $event_id;
                    $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);

                    $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
                    $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
                    $data['countPay'] = count($data['payments']);
                    $data['totalPays'] = $modelOrder->totalPaymentEvent($event_id, $start_date, $end_date);

                    $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
                    $data['datePros'] = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);
                    $data['countPro'] = count($data['promotions']);
                    $data['totalPros'] = $modelOrder->totalPromotionEvent($event_id, $start_date, $end_date);
                    $data['allTotalPro'] = $modelOrder->allTotalPromotion($event_id, $start_date, $end_date);
                    $data['modelOrder'] = $modelOrder;

                    $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id);
                    $data['allSale'] = $modelOrder->getAllSale($event_id);
                    $data['countAllCat'] = count($data['allCategories']);
                    $sheet->setAutoSize(false);

                    $sheet->loadView('backend.admin.tixtrack.export_report.excel',$data);

                });

            })->export('xlsx');
        }
    }

    public function exportReportToPdf(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-'.date('Y-m-d-H-i-s').'.pdf';
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $modelOrder = new TixtrackOrder();
            $modelEvent = new Event();
            $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
            $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
            $data['countCat'] = count($data['categories']);
            $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
            $data['event'] = $modelEvent->getEventByTixtrack($event_id);
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['event_id'] = $event_id;
            $data['total'] = $modelOrder->total($event_id, $start_date, $end_date);

            $data['payments'] = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
            $data['datePays'] = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);
            $data['countPay'] = count($data['payments']);
            $data['totalPays'] = $modelOrder->totalPaymentEvent($event_id, $start_date, $end_date);

            $data['promotions'] = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
            $data['datePros'] = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);
            $data['countPro'] = count($data['promotions']);
            $data['totalPros'] = $modelOrder->totalPromotionEvent($event_id, $start_date, $end_date);
            $data['allTotalPro'] = $modelOrder->allTotalPromotion($event_id, $start_date, $end_date);
            $data['modelOrder'] = $modelOrder;

            $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id);
            $data['allSale'] = $modelOrder->getAllSale($event_id);
            $data['countAllCat'] = count($data['allCategories']);

            $pdf = PDF::loadView('backend.admin.tixtrack.export_report.pdf', $data);
            return $pdf->setPaper('a4')->download($filename);
        }
    }

    public function truncateMember(){
        $model = new TixtrackCustomer();
        $model->truncate();
        return redirect()->route('admin-index-tixtrack');
    }

    public function truncateTransaction(){
        $model = new TixtrackOrder();
        $model->truncate();
        return redirect()->route('admin-index-tixtrack');
    }
}
