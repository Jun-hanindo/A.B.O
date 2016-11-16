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
use PHPExcel_Worksheet_Drawing;
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

                $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id, $end_date);
                $data['allSale'] = $modelOrder->getAllSale($event_id, $end_date);
                $data['countAllCat'] = count($data['allCategories']);

                $data['start_date'] = $start_date;
                $data['end_date'] = $end_date;
                $data['event_id'] = $event_id;
                $data['modelOrder'] = $modelOrder;
                $data['event'] = $modelEvent->getEventByTixtrack($event_id);

                $data['first_date'] = $modelOrder->getFirstDateEvent($event_id);


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

    public function chartCategory(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $modelOrder = new TixtrackOrder();
            $cats = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
            $dateCats = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);

            foreach ($dateCats as $key => $value) {
                $date = date('d-M-Y', strtotime($value->local_created))." | ".date('d-M-Y, g:ia', strtotime($value->event_date));
                $full_amount = 'Full Amount:';
                $disc_amount = 'Discounted Amt:';
                $quantity = 'Quantity:';
                $labels[] = [
                    $date." | ".$full_amount,
                    $date." | ".$disc_amount,
                    $date." | ".$quantity,
                ];

                $totals[] = [
                    $value->full_price,
                    $value->price,
                    $value->ticket_quantity,
                ];

                // $categories[] = array_flatten($cat);

            }  

            //$totals = array_flatten($totals);
            //$set['total'] = $totals; 

            $data['labels'] = array_flatten($labels);     

            foreach ($cats as $key => $value) {
                $categories[] = $value->price_level_name;
                foreach ($dateCats as $key2 => $value2) {
                    $date = date('d-M-Y', strtotime($value2->local_created)).'|'.date('d-M-Y, g:ia', strtotime($value2->event_date));
                    $amount = $modelOrder->amountByCategory($event_id, $value->price_level_name, $value2->local_created, $value2->event_date);
                    $amounts[$date] = [
                        $amount->full_price, 
                        $amount->price,
                        $amount->ticket_quantity
                    ];
                }
                $data['datasets'][] = [
                    'label' => $value->price_level_name,
                    'borderColor' => rand_color(),
                    'fill' => false,
                    'fillColor' => "rgba(220,220,220,0)",
                    'data' => array_flatten($amounts)
                ];
            } 

            $data['datasets'][] = [
                'label' => 'Total',
                'borderColor' => rand_color(),
                'fill' => false,
                'fillColor' => "rgba(220,220,220,0)",
                'data' => array_flatten($totals),
            ];
 
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        }
    }

    public function chartPayment(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $modelOrder = new TixtrackOrder();
            $modelEvent = new Event();
            $pays = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
            $datePays = $modelOrder->getPaymentByEvent($event_id, $start_date, $end_date);

            foreach ($datePays as $key => $value) {
                $date = date('d-M-Y', strtotime($value->local_created))." | ".date('d-M-Y, g:ia', strtotime($value->event_date));
                $full_amount = 'Full Amount:';
                $disc_amount = 'Discounted Amt:';
                $quantity = 'Quantity:';
                $labels[] = [
                    $date." | ".$full_amount,
                    $date." | ".$disc_amount,
                    $date." | ".$quantity,
                ];

                $totals[] = [
                    $value->full_price,
                    $value->price,
                    $value->ticket_quantity,
                ];

                // $a[] = $value->amounts;
                // foreach ($value->amounts as $key2 => $value2) {
                //     $cat[$key2] = [
                //         $value2->full_price, $value2->price, $value2->ticket_quantity
                //     ];
                // }

                // $categories[] = array_flatten($cat);

            }  

            $data['labels'] = array_flatten($labels);     

            foreach ($pays as $key => $value) {
                $categories[] = $value->payment_method_name;
                foreach ($datePays as $key2 => $value2) {
                    $date = date('d-M-Y', strtotime($value2->local_created)).'|'.date('d-M-Y, g:ia', strtotime($value2->event_date));
                    $amount = $modelOrder->amountByPayment($event_id, $value->payment_method_name, $value2->local_created, $value2->event_date);
                    $amounts[$date] = [
                        $amount->full_price, 
                        $amount->price,
                        $amount->ticket_quantity
                    ];
                }
                $data['datasets'][] = [
                    'label' => $value->payment_method_name,
                    'borderColor' => rand_color(),
                    'fill' => false,
                    'fillColor' => "rgba(220,220,220,0)",
                    'data' => array_flatten($amounts)
                ];
            } 

            $data['datasets'][] = [
                'label' => 'Total',
                'borderColor' => rand_color(),
                'fill' => false,
                'fillColor' => "rgba(220,220,220,0)",
                'data' => array_flatten($totals),
            ];

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        }
    }



    public function chartPromotion(Request $req){
        $param = $req->all();
        if(!empty($param)){
            // $param['event'] = 50748;
            // $param['start_date'] = '2016-11-01';
            // $param['end_date'] = '2016-11-11';
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $modelOrder = new TixtrackOrder();
            $modelEvent = new Event();
            $pros = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
            $datePros = $modelOrder->getDatePromotion($event_id, $start_date, $end_date);
            //$countCat = count($categories);
            //$totalCats = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
            //$event = $modelEvent->getEventByTixtrack($event_id);
            // $start_date = $start_date;
            // $end_date = $end_date;
            // $event_id = $event_id;
            //$total = $modelOrder->total($event_id, $start_date, $end_date);
            $data = array();
            if(!$datePros->isEmpty()){
                foreach ($datePros as $key => $value) {
                    $date = date('d-M-Y', strtotime($value->local_created))." | ".date('d-M-Y, g:ia', strtotime($value->event_date));
                    $full_amount = 'Full Amount:';
                    $disc_amount = 'Discounted Amt:';
                    $quantity = 'Quantity:';
                    $labels[] = [
                        $date." | ".$full_amount,
                        $date." | ".$disc_amount,
                        $date." | ".$quantity,
                    ];
                    $subtotal = $modelOrder->totalByDatePromotion($event_id, $value->local_created, $value->event_date);

                    $totals[] = [
                        $subtotal->full_price,
                        $subtotal->price,
                        $subtotal->ticket_quantity,
                    ];

                    // $a[] = $value->amounts;
                    // foreach ($value->amounts as $key2 => $value2) {
                    //     $cat[$key2] = [
                    //         $value2->full_price, $value2->price, $value2->ticket_quantity
                    //     ];
                    // }

                    // $categories[] = array_flatten($cat);

                }  

                //$totals = array_flatten($totals);
                //$set['total'] = $totals; 

                $data['labels'] = array_flatten($labels);  
            }   

            if(!$pros->isEmpty()){
                foreach ($pros as $key => $value) {
                    $categories[] = $value->promo_code;
                    foreach ($datePros as $key2 => $value2) {
                        $date = date('d-M-Y', strtotime($value2->local_created)).'|'.date('d-M-Y, g:ia', strtotime($value2->event_date));
                        $amount = $modelOrder->amountByPromotion($event_id, $value->promo_code, $value2->local_created, $value2->event_date);
                        $amounts[$date] = [
                            $amount->full_price, 
                            $amount->price,
                            $amount->ticket_quantity
                        ];
                    }
                    $data['datasets'][] = [
                        'label' => $value->promo_code,
                        'borderColor' => rand_color(),
                        'fill' => false,
                        'fillColor' => "rgba(220,220,220,0)",
                        'data' => array_flatten($amounts)
                    ];
                } 
            }

            if(!$datePros->isEmpty()){
                $data['datasets'][] = [
                    'label' => 'Total',
                    'borderColor' => rand_color(),
                    'fill' => false,
                    'fillColor' => "rgba(220,220,220,0)",
                    'data' => array_flatten($totals),
                ];
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ],200);
        }
    }

    
    public function exportReportToExcel(Request $req){
        $param = $req->all();
        if(!empty($param)){
            $filename = env('APP_NAME_INITIAL').'-Report-'.date('Y-m-d-H-i-s');
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

                    $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id, $end_date);
                    $data['allSale'] = $modelOrder->getAllSale($event_id, $end_date);
                    $data['countAllCat'] = count($data['allCategories']);

                    $data['first_date'] = $modelOrder->getFirstDateEvent($event_id);

                    $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
                    $data['first_date'] = $modelOrder->getFirstDateEvent($event_id);
                    $fileChartCat = 'ChartCategory'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                    $data['chartCat'] = public_path().'/uploads/charts/'.$fileChartCat;
                    $fileChartPay = 'ChartPayment'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                    $data['chartPay'] = public_path().'/uploads/charts/'.$fileChartPay;
                    $fileChartPro = 'ChartPromotion'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                    $data['chartPro'] = public_path().'/uploads/charts/'.$fileChartPro;

                    if(!$data['dateCats']->isEmpty()){
                        $drawing = new PHPExcel_Worksheet_Drawing();
                        $drawing->setPath($data['chartCat']); //your image path
                        $cCat = (count($data['dateCats']) * 3) + 12;
                        $drawing->setCoordinates('A'.$cCat);
                        $drawing->setWorksheet($sheet);
                        $sheet->getRowDimension($cCat)->setRowHeight(320);
                    }

                    if(!$data['datePays']->isEmpty()){
                        $drawingPay = new PHPExcel_Worksheet_Drawing();
                        $drawingPay->setPath($data['chartPay']); //your image path
                        $cPay = (count($data['datePays']) * 3) + $cCat + 7;
                        $drawingPay->setCoordinates('A'.$cPay);
                        $drawingPay->setWorksheet($sheet);
                        $sheet->getRowDimension($cPay)->setRowHeight(320);
                    }

                    if(!$data['datePros']->isEmpty()){
                        $drawingPro = new PHPExcel_Worksheet_Drawing();
                        $drawingPro->setPath($data['chartPro']); //your image path
                        $cPro = (count($data['datePros']) * 3) + $cPay + 7;
                        $drawingPro->setCoordinates('A'.$cPro);
                        $drawingPro->setWorksheet($sheet);
                        $sheet->getRowDimension($cPro)->setRowHeight(320);
                    }
                    //$sheet->setAutoSize(false);

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

            $data['allCategories'] = $modelOrder->getAllCategoryEvent($event_id, $end_date);
            $data['allSale'] = $modelOrder->getAllSale($event_id, $end_date);
            $data['countAllCat'] = count($data['allCategories']);

            $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
            $data['first_date'] = $modelOrder->getFirstDateEvent($event_id);
            $fileChartCat = 'ChartCategory'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
            $data['chartCat'] = public_path().'/uploads/charts/'.$fileChartCat;
            $fileChartPay = 'ChartPayment'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
            $data['chartPay'] = public_path().'/uploads/charts/'.$fileChartPay;
            $fileChartPro = 'ChartPromotion'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
            $data['chartPro'] = public_path().'/uploads/charts/'.$fileChartPro;

            $pdf = PDF::loadView('backend.admin.tixtrack.export_report.pdf', $data);
            return $pdf->setPaper('A4')->download($filename);
            
            // return view('backend.admin.tixtrack.export_report.pdf', $data);
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

    public function chartImage(Request $req){
        try{
            $param = $req->all();
            // $param['event'] = 50748;
            // $param['start_date'] = '2016-11-01';
            // $param['end_date'] = '2016-11-11';
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
            $pathDest = public_path( 'uploads/charts' );
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }
            //dd($param['category']);
            if(isset($param['category'])){
                $imgbase1 = str_replace('data:image/png;base64,', '', $param['category']);
                $img1 = base64_decode($imgbase1);
                $filename1 = 'ChartCategory'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename1);
                // Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                //     'charts/'.$filename1, $img1, 'public'
                // );
                File::put($pathDest.'/'.$filename1, $img1);
            }
            if(isset($param['payment'])){
                $imgbase2 = str_replace('data:image/png;base64,', '', $param['payment']);
                $img2 = base64_decode($imgbase2);
                $filename2 = 'ChartPayment'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename2);
                // Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                //     'charts/'.$filename2, $img2, 'public'
                // );
                File::put($pathDest.'/'.$filename2, $img2);
            }
            if(isset($param['promotion'])){
                $imgbase3 = str_replace('data:image/png;base64,', '', $param['promotion']);
                $img3 = base64_decode($imgbase3);
                $filename3 = 'ChartPromotion'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename3);
                // Storage::disk(env('FILESYSTEM_DEFAULT'))->put(
                //     'charts/'.$filename3, $img3, 'public'
                // );
                File::put($pathDest.'/'.$filename3, $img3);
            }
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
            ],200);

        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);
            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-report-tixtrack');
        
        }
    }
}
