<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\TixtrackAccount;
use App\Http\Controllers\Backend\Admin\BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use File;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
//use GuzzleHttp\Cookie\CookieJar;
//use GuzzleHttp\Cookie\CookieJarInterface;

class DownloadController extends BaseController
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

    public function changeAccount(Request $req){
        $param = $req->all();
        $accountID = $param['account'];
        \Session::put('AccountID', $accountID);
        $client = new Client();

        $request = new GuzzleRequest('PUT', 'https://nliven.co/api/admin/userprofiles/swapaccounts/'.$accountID, [
            'Cookie' => $this->cookie(),
        ]);
        $response = $client->send($request);

        $status = $response->getStatusCode();
        if($status == 200){
            flash()->success('Change Account/Event success!');
        }else{
            flash()->error('Change Account/Event failed');
        }

        return redirect()->route('admin-tixtrack-download');
    }

    public function download(){

        if (\Session::has('ASPXAUTH')) {

            $trail = 'Tixtrack download';
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

            return view('backend.admin.tixtrack.download', $data);
        }else{
            return redirect()->route('admin-tixtrack-login');
        }
    }

    public function downloadMember(Request $req){
        $param = $req->all();
        $accountModel = new TixtrackAccount();
        if (\Session::has('AccountID')) {
            $AccountID = \Session::get('AccountID'); 
        }else{
            $AccountID = '';
        }
        $data['account_selected'] = $AccountID;
        $data['account'] = $accountModel->getTixtrackAccount();
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path().'/donwloads';
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            // $param = [
            //     "ID" => 0,
            //     "Name" => "",
            //     "Save" => false,
            //     "FilterGroups" => [
            //         [
            //             "FilterConditions" => [
            //                 [
            //                     "HasCondition" => true,
            //                     "Available Values" => [],
            //                     "AttributeName" => "FirstName",
            //                     "ChainOperator" => null,
            //                     "ConditionValue" => "jun",
            //                     "AvailableOperators" => ["=","Contains","Has A Value","Starts With","Ends With"],
            //                     "OperatorValue" => "=",
            //                     "IsDate" => false,
            //                     "IsTime" => false,
            //                 ]
            //             ],
            //             "ChainOperator" => null
            //         ]
            //     ],
            // ];
            // $data = urlencode (json_encode($param));

            if(!empty($param)){
                $filter_members = $param['member'];
                //dd($param);
                $condition = [];
                $total = count($filter_members);
                $i = 1;
                foreach ($filter_members as $key => $filter_member) {
                    if($i == $total){
                        $chainOperator = null;
                    }else{
                        $chainOperator = $filter_member['ChainOperator'];
                    }

                    if($filter_member['AttributeName'] == 'FraudStatus'){
                        $availableOperators = ["="];
                        $availableValues = ["Uncategorized","PendingReview","Valid","Fraud","Inconclusive"];
                    }elseif($filter_member['AttributeName'] == 'UserId'){
                        $availableOperators = ["=",">=","<="];
                        $availableValues = [];
                    }else{
                        $availableOperators = ["=","Contains","Has A Value","Starts With","Ends With"];
                        $availableValues = [];
                    }
                    $condition[] = [
                        "HasCondition" => true,
                        "AvailableValues" => $availableValues,
                        "AttributeName" => $filter_member['AttributeName'],
                        "ChainOperator" => $chainOperator,
                        "ConditionValue" => $filter_member['ConditionValue'],
                        "AvailableOperators" => $availableOperators,
                        "OperatorValue" => $filter_member['OperatorValue'],
                        "IsDate" => false,
                        "IsTime" => false,
                    ];
                    $i++;
                }

                $member = [
                    "ID" => 0,
                    "Name" => "",
                    "Save" => false,
                    "FilterGroups" => [
                        [
                            "FilterConditions" => $condition,
                            "ChainOperator" => null
                        ]
                    ],
                ]; 
                $member = json_encode($member);
                //$member = urlencode (json_encode($member));
                //dd($member);
        
                $file_member = $pathDest.'/Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON='.$member, [
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_member,
                ]);
            }else{
                $file_member = $pathDest.'/Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_member,
                ]);

            }
            //print_r($response);exit;
            $status = $response->getStatusCode();
            if($status == 200){
                flash()->success('Download Member success!');
                return \Response::download($file_member)->deleteFileAfterSend(true);
            }else{
                flash()->error('Download Member failed');
            }
            return view('backend.admin.tixtrack.download', $data);
            //exit;
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Download Member failed');
            return view('backend.admin.tixtrack.download', $data);
        
        }
    }

    public function downloadTransaction(Request $req){

        $param = $req->all();
        $accountModel = new TixtrackAccount();
        if (\Session::has('AccountID')) {
            $AccountID = \Session::get('AccountID'); 
        }else{
            $AccountID = '';
        }
        $data['account_selected'] = $AccountID;
        $data['account'] = $accountModel->getTixtrackAccount();
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path().'/donwloads';
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            // $param = [
            //     "FilterGroups" => [
            //         [
            //             "FilterConditions" => [
            //                 [
            //                     "HasCondition" => true,
            //                     "AvailableValues" => [],
            //                     "AttributeName" => "FirstName",
            //                     "ChainOperator" => null,
            //                     "ConditionValue" => "aaron",
            //                     "AvailableOperators" => ["=","Contains","Has A Value","Starts With","Ends With"],
            //                     "OperatorValue" => "=",
            //                     "IsDate" => false,
            //                     "IsTime" => false,
            //                 ]
            //             ],
            //             "ChainOperator" => null
            //         ]
            //     ],
            // ];
            //$transaction = json_encode($param);
            //$transaction = urlencode (json_encode($param));
            $transaction = $param;

            if(!empty($param)){
                $filter_transactions = $param['transaction'];
                //dd($param);
                $condition = [];
                $total = count($filter_transactions);
                $i = 1;
                foreach ($filter_transactions as $key => $filter_transaction) {
                    if($i == $total){
                        $chainOperator = null;
                    }else{
                        $chainOperator = $filter_transaction['ChainOperator'];
                    }

                    if($filter_transaction['AttributeName'] == 'Customer.FraudStatus' || $filter_transaction['AttributeName'] == 'Event.AwayTeam.Sport' || 
                        $filter_transaction['AttributeName'] == 'Event.DayOfWeek' || $filter_transaction['AttributeName'] == 'Event.TimePeriod' || 
                        $filter_transaction['AttributeName'] == 'OrderStatus' || $filter_transaction['AttributeName'] == 'SalesChannel' || 
                        $filter_transaction['AttributeName'] == 'Seller.FraudStatus'){
                            $availableOperators = ["="];
                    }elseif($filter_transaction['AttributeName'] == 'Balance' || $filter_transaction['AttributeName'] == 'Customer.UserId' || 
                        $filter_transaction['AttributeName'] == 'Event.EventTemplate.ID' || $filter_transaction['AttributeName'] == 'Event.ID' ||
                        $filter_transaction['AttributeName'] == 'Event.LocalDate' || $filter_transaction['AttributeName'] == 'Event.TimeOfDay' || 
                        $filter_transaction['AttributeName'] == 'Event.Venue.ID' || $filter_transaction['AttributeName'] == 'Event.VenueConfig.ID' ||
                        $filter_transaction['AttributeName'] == 'EventID' || $filter_transaction['AttributeName'] == 'FraudScore' || 
                        $filter_transaction['AttributeName'] == 'ID' || $filter_transaction['AttributeName'] == 'LocalCreated' || 
                        $filter_transaction['AttributeName'] == 'Partner.ID' || $filter_transaction['AttributeName'] == 'Partner.PartnerCategoryID' || 
                        $filter_transaction['AttributeName'] == 'Seller.UserId' || $filter_transaction['AttributeName'] == 'Total'){
                        $availableOperators = ["=",">=","<="];
                    }elseif($filter_transaction['AttributeName'] == 'Event.Active' || $filter_transaction['AttributeName'] == 'Event.HasProducts' || 
                        $filter_transaction['AttributeName'] == 'Event.RequireRecaptcha' || $filter_transaction['AttributeName'] == 'IsFraud'){
                            $availableOperators = ["Is"];
                    }else{
                        $availableOperators = ["=","Contains","Has A Value","Starts With","Ends With"];
                    }

                    if($filter_transaction['AttributeName'] == 'Customer.FraudStatus' || $filter_transaction['AttributeName'] == 'Seller.FraudStatus'){
                            $availableValues = ["Uncategorized","PendingReview","Valid","Fraud","Inconclusive"];
                    }elseif($filter_transaction['AttributeName'] == 'SalesChannel'){
                            $availableValues = ["Web", "PointOfSale", "StubHub", "VividSeats", "Outlet", "API", "HouseSeats"];
                    }elseif($filter_transaction['AttributeName'] == 'OrderStatus'){
                            $availableValues = ["Accepted", "Cancelled"];
                    }elseif($filter_transaction['AttributeName'] == 'IsFraud' || $filter_transaction['AttributeName'] == 'Event.RequireRecaptcha' || 
                        $filter_transaction['AttributeName'] == 'Event.HasProducts' || $filter_transaction['AttributeName'] == 'Event.Active'){
                            $availableValues = ["True", "False"];
                    }else if($filter_transaction['AttributeName'] == 'Event.TimePeriod'){
                            $availableValues = ["Morning", "Afternoon", "Evening"];
                    }else if($filter_transaction['AttributeName'] == 'Event.DayOfWeek'){
                            $availableValues = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    }else if($filter_transaction['AttributeName'] == 'Event.AwayTeam.Sport'){
                            $availableValues = ["Basketball", "Baseball", "Football", "Soccer"];
                    }else{
                            $availableValues = [];
                    }

                    if($filter_transaction['AttributeName'] == 'LocalCreated' || $filter_transaction['AttributeName'] == 'Event.LocalDate'){
                        $isDate = true;
                    }else{
                        $isDate = false;
                    }

                    if($filter_transaction['AttributeName'] == 'Event.TimeOfDay'){
                        $IsTime = true;
                    }else{
                        $IsTime = false;
                    }

                    $condition[] = [
                        "HasCondition" => true,
                        "AvailableValues" => $availableValues,
                        "AttributeName" => $filter_transaction['AttributeName'],
                        "ChainOperator" => $chainOperator,
                        "ConditionValue" => $filter_transaction['ConditionValue'],
                        "AvailableOperators" => $availableOperators,
                        "OperatorValue" => $filter_transaction['OperatorValue'],
                        "IsDate" => $isDate,
                        "IsTime" => $IsTime,
                    ];
                    $i++;
                }

                $transaction = [
                    "FilterGroups" => [
                        [
                            "FilterConditions" => $condition,
                            "ChainOperator" => null
                        ]
                    ],
                ]; 

                $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i-s').'.csv';

                $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                    'headers' => ['Content-Type' => 'application/json;charset=UTF-8', 'Accept' => 'application/json'],
                    'Cookie' => $this->cookie(),
                ]);

                $response = $client->send($request, [
                    'save_to' => $file_transaction,
                    'json'    => $transaction,
                ]);
                
            }else{
                $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i').'.csv';
                $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                    'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_transaction,
                ]);
            }
            //print_r($response);exit;
            $status = $response->getStatusCode();
            if($status == 200){
                flash()->success('Download Transaction success!');
                return \Response::download($file_transaction)->deleteFileAfterSend(true);
            }else{
                flash()->error('Download Transaction failed');
            }
            return view('backend.admin.tixtrack.download', $data);
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Download Transaction failed');
            return view('backend.admin.tixtrack.download', $data);
        
        }
    }
}
