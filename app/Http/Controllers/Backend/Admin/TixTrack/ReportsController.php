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
    
    /**
     * Show tixtrack list page
     * @return Response
     */
    public function index()
    {
        try{
            
            $trail['desc'] = 'List Member and Transaction Tixtrack';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

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

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }
    }

    /**
     * Show list for member tixtrack
     * @param  Request $req  Parameter for filter such as account_id, customer_id, first_name, last_name, and email
     * @return Response
     */
    public function datatablesMember(Request $req)
    {
        $modelMember = new TixtrackCustomer();
        $param = $req->all();
        if(!empty($param)){
            $model = $modelMember->datatablesFilter($param);
        }else{
            $model = $modelMember->datatables();
        }
        return datatables($model)
            ->addColumn('action', function ($member) {
                
            })
            ->make(true);
    }

    /**
     * Show list for transaction tixtrack
     * @param  Request $req Parameter for filter such as account_id, order_status, order_item_type, from_data and until_date
     * @return Response
     */
    public function datatablesTransaction(Request $req)
    {
        $modelTransaction = new TixtrackOrder();
        $param = $req->all();
        if(!empty($param)){
            $model = $modelTransaction->datatablesFilter($param);
        }else{
            $model = $modelTransaction->datatables();
        }
        return datatables($model)
            ->editColumn('local_created', function($data){
                $date = short_text_date_time($data->local_created);
                return $date;
            })
            ->filterColumn('customer', function($query, $keyword) {
                $query->whereRaw("LOWER(CAST(CONCAT(tixtrack_orders.first_name, ' ', tixtrack_orders.last_name) as TEXT)) ilike ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    /**
     * Show result report tixtrack page
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return Response
     */
    public function report(Request $req)
    {
        try{
            $trail['desc'] = 'Report Tixtrack';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

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
                $data['event'] = $modelOrder->getEventByName($event_id);

                $data['first_date'] = $modelOrder->getFirstDateEvent($event_id);
                $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
                $data['filename'] = env('APP_NAME_INITIAL').'-Report-'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.pdf';


            }

            $data['events'] = $modelOrder->getEvent();
            return view('backend.admin.tixtrack.report', $data);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            flash()->error(trans('general.data_not_found'));
            return redirect()->route('admin-report-tixtrack');
        
        }
    }

    /**
     * Get data for category chart
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return json       Response
     */
    public function chartCategory(Request $req)
    {
        try{
            $param = $req->all();
            if(!empty($param)){
                $event_id = $param['event'];
                $start_date = $param['start_date'];
                $end_date = $param['end_date'];
                $modelOrder = new TixtrackOrder();
                $cats = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                $dates = $modelOrder->getDateGroupLocal($event_id, $start_date, $end_date);

                foreach ($dates as $key => $value) {
                    $date = date('D,d-M-y', strtotime($value->local_created));
                    $labels[] = [
                        $date,
                    ];

                }  

                $data['labels'] = array_flatten($labels);     

                $color = 0;
                foreach ($cats as $key => $value) {
                    $categories[] = $value->price_level_name;
                    foreach ($dates as $key2 => $value2) {
                        $date = date('D,d-M-y', strtotime($value2->local_created));
                        $amount = $modelOrder->amountByCategory($event_id, $value->price_level_name, $value2->local_created, '');
                        $amounts[$date] = [
                            $amount->ticket_quantity
                        ];
                    }
                    $data['datasets'][] = [
                        'label' => $value->price_level_name,
                        'borderColor' => rand_color2($color),
                        'fill' => false,
                        'fillColor' => "rgba(220,220,220,0)",
                        'data' => array_flatten($amounts)
                    ];
                    $color++;
                } 
     
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => $data
                ],200);
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Error',
                'data' => $data
            ],400);
        
        }
    }

    /**
     * Get data for payment chart
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return json       Response
     */
    public function chartPayment(Request $req)
    {
        try{
            $param = $req->all();
            if(!empty($param)){
                $event_id = $param['event'];
                $start_date = $param['start_date'];
                $end_date = $param['end_date'];
                $modelOrder = new TixtrackOrder();
                $modelEvent = new Event();
                $pays = $modelOrder->getPaymentEvent($event_id, $start_date, $end_date);
                $dates = $modelOrder->getDateGroupLocal($event_id, $start_date, $end_date);

                foreach ($dates as $key => $value) {
                    $date = date('D,d-M-y', strtotime($value->local_created));
                    $labels[] = [
                        $date,
                    ];

                }  

                $data['labels'] = array_flatten($labels);     

                $color = 10;
                foreach ($pays as $key => $value) {
                    $categories[] = $value->payment_method_name;
                    foreach ($dates as $key2 => $value2) {
                        $date = date('D,d-M-y', strtotime($value2->local_created));
                        $amount = $modelOrder->amountByPayment($event_id, $value->payment_method_name, $value2->local_created, '');
                        $amounts[$date] = [
                            $amount->ticket_quantity
                        ];
                    }
                    $data['datasets'][] = [
                        'label' => $value->payment_method_name,
                        'borderColor' => rand_color2($color),
                        'fill' => false,
                        'fillColor' => "rgba(220,220,220,0)",
                        'data' => array_flatten($amounts)
                    ];
                    $color++;
                } 

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => $data
                ],200);
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Error',
                'data' => $data
            ],400);
        
        }
    }

    /**
     * Get data for promotion chart
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return json       Response
     */
    public function chartPromotion(Request $req)
    {
        try{

            $param = $req->all();
            if(!empty($param)){
                $event_id = $param['event'];
                $start_date = $param['start_date'];
                $end_date = $param['end_date'];
                $modelOrder = new TixtrackOrder();
                $modelEvent = new Event();
                $pros = $modelOrder->getPromotionEvent($event_id, $start_date, $end_date);
                $dates = $modelOrder->getDatePromotionGroupLocal($event_id, $start_date, $end_date);
                $data = array();
                if(!$dates->isEmpty()){
                    foreach ($dates as $key => $value) {
                        $date = date('D,d-M-y', strtotime($value->local_created));
                        $labels[] = [
                            $date,
                        ];

                    }  

                    $data['labels'] = array_flatten($labels);  
                }   

                $color = 20;
                if(!$pros->isEmpty()){
                    foreach ($pros as $key => $value) {
                        $categories[] = $value->promo_code;
                        foreach ($dates as $key2 => $value2) {
                        $date = date('D,d-M-y', strtotime($value2->local_created));
                            $amount = $modelOrder->amountByPromotion($event_id, $value->promo_code, $value2->local_created, '');
                            $amounts[$date] = [
                                $amount->ticket_quantity
                            ];
                        }
                        $data['datasets'][] = [
                            'label' => $value->promo_code,
                            'borderColor' => rand_color2($color),
                            'fill' => false,
                            'fillColor' => "rgba(220,220,220,0)",
                            'data' => array_flatten($amounts)
                        ];
                        $color++;
                    } 
                }

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => $data
                ],200);
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Error',
                'data' => $data
            ],400);
        
        }
    }

    /**
     * Export data to excel
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return Response excel file
     */
    public function exportReportToExcel(Request $req)
    {
        try{
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
                        $data['event'] = $modelOrder->getEventByName($event_id);
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
                            $sheet->getRowDimension($cCat)->setRowHeight(253);
                        }

                        if(!$data['datePays']->isEmpty()){
                            $drawingPay = new PHPExcel_Worksheet_Drawing();
                            $drawingPay->setPath($data['chartPay']); //your image path
                            $cPay = (count($data['datePays']) * 3) + $cCat + 7;
                            $drawingPay->setCoordinates('A'.$cPay);
                            $drawingPay->setWorksheet($sheet);
                            $sheet->getRowDimension($cPay)->setRowHeight(253);
                        }

                        if(!$data['datePros']->isEmpty()){
                            $drawingPro = new PHPExcel_Worksheet_Drawing();
                            $drawingPro->setPath($data['chartPro']); //your image path
                            $cPro = (count($data['datePros']) * 3) + $cPay + 7;
                            $drawingPro->setCoordinates('A'.$cPro);
                            $drawingPro->setWorksheet($sheet);
                            $sheet->getRowDimension($cPro)->setRowHeight(253);
                        }

                        $sheet->loadView('backend.admin.tixtrack.export_report.excel',$data);

                    });

                })->export('xlsx');
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }
    }

    /**
     * Export data to pdf
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return Response pdf file
     */
    public function exportReportToPdf(Request $req)
    {
        try{
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
                $data['event'] = $modelOrder->getEventByName($event_id);
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
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }
    }

    /**
     * Save chart image
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return json Response
     */
    public function chartImage(Request $req)
    {
        try{
            $param = $req->all();
            $event_id = $param['event'];
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
            $pathDest = public_path( 'uploads/charts' );
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            } 

            if(isset($param['category'])){
                $imgbase1 = str_replace('data:image/png;base64,', '', $param['category']);
                $img1 = base64_decode($imgbase1);
                $filename1 = 'ChartCategory'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename1);

                File::put($pathDest.'/'.$filename1, $img1);
            }
            if(isset($param['payment'])){
                $imgbase2 = str_replace('data:image/png;base64,', '', $param['payment']);
                $img2 = base64_decode($imgbase2);
                $filename2 = 'ChartPayment'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename2);

                File::put($pathDest.'/'.$filename2, $img2);
            }
            if(isset($param['promotion'])){
                $imgbase3 = str_replace('data:image/png;base64,', '', $param['promotion']);
                $img3 = base64_decode($imgbase3);
                $filename3 = 'ChartPromotion'.$event_id.'-'.$start_date.'-'.$end_date.'-'.$user.'.png';
                File::delete($pathDest.'/'.$filename3);

                File::put($pathDest.'/'.$filename3, $img3);
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
            ],200);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Error',
                'data' => $data
            ],400);
        
        }
    }

    /**
     * Save automatic report in pdf
     * @param  Request $req  Parameter for filter such as event for event name, start_date as from date and end_date as until date
     * @return Response pdf file
     */
    public function saveReportToPdf(Request $req)
    {
        try{
            $param = $req->all();
            if(!empty($param)){
                $event_id = $param['event'];
                $start_date = $param['start_date'];
                $end_date = $param['end_date'];
                $pathDest = public_path( 'uploads/reports' );
                if(!File::exists($pathDest)) {
                    File::makeDirectory($pathDest, $mode=0777,true,true);
                }
                $user = \Sentinel::getUser()->first_name.'-'.\Sentinel::getUser()->last_name;
                $filename = env('APP_NAME_INITIAL').'-Report-'.str_replace('"', "", $event_id).'-'.$start_date.'-'.$end_date.'-'.$user.'.pdf';
                if(file_exists($pathDest.'/'.$filename)){
                    File::delete($pathDest.'/'.$filename);
                }
                $modelOrder = new TixtrackOrder();
                $modelEvent = new Event();
                $data['categories'] = $modelOrder->getCategoryEvent($event_id, $start_date, $end_date);
                $data['dateCats'] = $modelOrder->getCategoryByEvent($event_id, $start_date, $end_date);
                $data['countCat'] = count($data['categories']);
                $data['totalCats'] = $modelOrder->totalCategoryEvent($event_id, $start_date, $end_date);
                $data['event'] = $modelOrder->getEventByName($event_id);
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
                
                File::put($pathDest.'/'.$filename, $pdf->output());
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Success',
                    'data' => url( 'uploads/reports' ).'/'.$filename,
                ],200);
            }

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Error',
                'data' => $data
            ],400);
        
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
