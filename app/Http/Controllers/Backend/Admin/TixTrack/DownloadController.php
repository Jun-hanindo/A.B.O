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
use Excel;
use DB;
use App\Models\TixtrackCustomer;
use PHPExcel_Settings;
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
        // testing
        // $pathDest = public_path().'/downloads';
        // $file = '/Download_member_2016-10-27-10-45-33.csv'; //member gourmet
        // $file2 = '/Download_member_2016-10-26-17-40-05.csv'; //member asiabox
        // $file3 = '/sample.csv';

        // $upload = Excel::load($pathDest.$file2, function($reader) {
        //        $reader->toArray();
        // }, 'ISO-8859-1')->get();
        //         // exit;
        //         // echo 'Plain    : ', iconv("UTF-8", "ISO-8859-1", $text), PHP_EOL;
        // //dd($upload->toArray());
        // if(!empty($upload)){
        //     foreach ($upload->toArray() as $key => $value) {
        //         //$insert[] = ['id' => $value->id, 'email' => $value->email];
        //         // print_r($value->id);
        //         // exit;
        //         //dd(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value));
        //         //dd(preg_replace('/[\x00-\n]/', '', $value['id']));
        //         dd(mb_convert_encoding($value['first_name'], 'UTF-8', 'ASCII'));
        //         //var_dump($value["id"]);
        //         //die();
        //         $customer_id = preg_replace('/[\x00-\n]/', '', $value['id']);
        //         $modelCustomer = new TixtrackCustomer();
        //         $data = $modelCustomer->findTixtrackCustomerByCutomerID($customer_id);
        //         $insert/*[]*/ = [
        //             'customer_id' => $customer_id,
        //             'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
        //             'first_name' => preg_replace('/[\x00-\n]/', '', $value['first_name']),
        //             'last_name' => preg_replace('/[\x00-\n]/', '', $value['last_name']),
        //             'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
        //             'bill_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_1']),
        //             'bill_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_2']),
        //             'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['bill_to_city']),
        //             'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['bill_to_state']),
        //             'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['bill_to_postal_code']),
        //             'bill_to_country' => preg_replace('/[\x00-\n]/', '', $value['bill_to_country']),
        //             'ship_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_1']),
        //             'ship_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_2']),
        //             'ship_to_city' => preg_replace('/[\x00-\n]/', '', $value['ship_to_city']),
        //             'ship_to_state' => preg_replace('/[\x00-\n]/', '', $value['ship_to_state']),
        //             'ship_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['ship_to_postal_code']),
        //             'ship_to_country' => preg_replace('/[\x00-\n]/', '', $value['ship_to_country'])
        //         ];
        //         if(empty($data)){
        //             TixtrackCustomer::create($insert);
        //         }else{
        //             TixtrackCustomer::where('customer_id',$customer_id)->update($insert);
        //         }
        //         //dd($insert);
        //         // dd($data);
        //         // exit;
        //        // $modelTixtrackCustomer = new TixtrackCustomer();
        //        // $modelTixtrackCustomer->create(['id' => $value->id, 'email' => $value->email]);
             
        //     }
        //     //dd($insert);
        //     // if(!empty($insert)){
        //     //     //TixtrackCustomer::create($insert);
        //     //     //DB::table('tixtrack_customers')->insert($insert);
        //     //     dd('Insert Record successfully.');
        //     // }
        // }
        // exit;
        // end testing


        $param = $req->all();
        if (!\Session::has('ASPXAUTH')) {
            return redirect()->route('admin-tixtrack-login');
        }
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path( 'downloads' );
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            if(!empty($param)){
                $filter_members = $param['member'];
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
        
                $filename = 'Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $file_member = $pathDest.'/'.$filename;
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON='.$member, [
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_member,
                ]);
            }else{
                $filename = 'Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $file_member = $pathDest.'/'.$filename;
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_member,
                ]);

            }
            
            $status = $response->getStatusCode();
            // if($status == 200){
            //     // $upload = Excel::load($file_member, function($reader) {
            //     //     $reader->toArray();
            //     // }, 'ISO-8859-1')->get();

            //     // if(!empty($upload)){
            //     //     foreach ($upload->toArray() as $key => $value) {
            //     //         $customer_id = preg_replace('/[\x00-\n]/', '', $value['id']);
            //     //         $modelCustomer = new TixtrackCustomer();
            //     //         $customer = $modelCustomer->findTixtrackCustomerByCutomerID($customer_id);
            //     //         $newData/*[]*/ = [
            //     //             'customer_id' => $customer_id,
            //     //             'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
            //     //             'first_name' => preg_replace('/[\x00-\n]/', '', $value['first_name']),
            //     //             'last_name' => preg_replace('/[\x00-\n]/', '', $value['last_name']),
            //     //             'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
            //     //             'bill_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_1']),
            //     //             'bill_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_2']),
            //     //             'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['bill_to_city']),
            //     //             'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['bill_to_state']),
            //     //             'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['bill_to_postal_code']),
            //     //             'bill_to_country' => preg_replace('/[\x00-\n]/', '', $value['bill_to_country']),
            //     //             'ship_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_1']),
            //     //             'ship_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_2']),
            //     //             'ship_to_city' => preg_replace('/[\x00-\n]/', '', $value['ship_to_city']),
            //     //             'ship_to_state' => preg_replace('/[\x00-\n]/', '', $value['ship_to_state']),
            //     //             'ship_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['ship_to_postal_code']),
            //     //             'ship_to_country' => preg_replace('/[\x00-\n]/', '', $value['ship_to_country'])
            //     //         ];
            //     //         if(empty($customer)){
            //     //             TixtrackCustomer::create($newData);
            //     //         }else{
            //     //             TixtrackCustomer::where('customer_id',$customer_id)->update($newData);
            //     //         }
                     
            //     //     }
            //     // }
            //     flash()->success('Import Member success');
            // }else{
            //     flash()->error('Import Member failed');
            // }
            //file_delete('downloads/'.$filename, env('FILESYSTEM_DEFAULT'));
            //File::delete($pathDest.'/'.$filename);
            if($status == 200){
                flash()->success('Download Transaction success!');
                return \Response::download($file_member)->deleteFileAfterSend(true);
            }else{
                flash()->error('Download Transaction failed');
            }
            return redirect()->route('admin-tixtrack-download');
            
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Download Member failed');
            return redirect()->route('admin-tixtrack-download');
        
        }
    }

    public function downloadTransaction(Request $req){
        // testing
        // $pathDest = public_path().'/downloads';
        // $file = '/Download_transaction_2016-10-28-09-50-05.csv'; //member gourmet
        // $file2 = '/Download_member_2016-10-26-17-40-05.csv'; //member asiabox
        // $file3 = '/sample.csv';
        // // $upload = Excel::load($pathDest.$file, function($reader) {
        // //     //dd($reader);
        // //     //$reader->toArray();
        // //     $reader->get()->toArray();
        // // });
        // $upload = Excel::load($pathDest.$file, function($reader) {
        //        $reader->toArray();
        //    })->get();
        //         // exit;
        // dd($upload->toArray());
        // if(!empty($upload)){
        //     foreach ($upload->toArray() as $key => $value) {
        //         //$insert[] = ['id' => $value->id, 'email' => $value->email];
        //         // print_r($value->id);
        //         // exit;
        //         //dd(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value));
        //         //dd(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value->first_name));
        //         $insert[] = [
        //             'customer_id' => $value['id'],
        //             'email' => $value['email'],
        //             'first_name' => $value['first_name'], "ASCII", "UTF-8",
        //             'last_name' => $value['last_name'],
        //             'phone' => $value['phone'],
        //             'bill_to_address_1' => $value['bill_to_address_1'],
        //             'bill_to_address_2' => $value['bill_to_address_2'],
        //             'bill_to_city' => $value['bill_to_city'],
        //             'bill_to_state' => $value['bill_to_state'],
        //             'bill_to_postal_code' => $value['bill_to_postal_code'],
        //             'bill_to_country' => $value['bill_to_country'],
        //             'ship_to_address_1' => $value['ship_to_address_1'],
        //             'ship_to_address_2' => $value['ship_to_address_2'],
        //             'ship_to_city' => $value['ship_to_city'],
        //             'ship_to_state' => $value['ship_to_state'],
        //             'ship_to_postal_code' => $value['ship_to_postal_code'],
        //             'ship_to_country' => $value['ship_to_country']

        //         ];
        //         //TixtrackCustomer::create($insert);
        //         //dd($insert);
        //         // dd($data);
        //         // exit;
        //        // $modelTixtrackCustomer = new TixtrackCustomer();
        //        // $modelTixtrackCustomer->create(['id' => $value->id, 'email' => $value->email]);
             
        //     }
        //     dd($insert);
        //     // if(!empty($insert)){
        //     //     //TixtrackCustomer::create($insert);
        //     //     //DB::table('tixtrack_customers')->insert($insert);
        //     //     dd('Insert Record successfully.');
        //     // }
        // }
        // exit;
        // end testing
        

        $param = $req->except('_token');
        if (!\Session::has('ASPXAUTH')) {
            return redirect()->route('admin-tixtrack-login');
        }
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path().'/downloads';
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
            //$transaction = $param;
            //dd($param);

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
            return redirect()->route('admin-tixtrack-download');
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Download Transaction failed');
            return redirect()->route('admin-tixtrack-download');
        
        }
    }
}
