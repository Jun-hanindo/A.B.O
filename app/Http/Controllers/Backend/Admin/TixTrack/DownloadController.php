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
use App\Models\TixtrackOrder;
use League\Csv\Reader;
use League\Csv\Writer;
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

    // public function changeAccount(Request $req){
    //     $param = $req->all();
    //     $accountID = $param['account'];
    //     \Session::put('AccountID', $accountID);
    //     $client = new Client();

    //     $request = new GuzzleRequest('PUT', 'https://nliven.co/api/admin/userprofiles/swapaccounts/'.$accountID, [
    //         'Cookie' => $this->cookie(),
    //     ]);
    //     $response = $client->send($request);

    //     $status = $response->getStatusCode();
    //     if($status == 200){
    //         flash()->success('Change Account/Event success!');
    //     }else{
    //         flash()->error('Change Account/Event failed');
    //     }

    //     return redirect()->route('admin-tixtrack-download');
    // }
    
    public function changeAccount(Request $req){
        $modelCustomer = new TixtrackCustomer();
        $modelOrder = new TixtrackOrder();
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
            //flash()->success('Change Account/Event success!');
            $pathDest = public_path( 'downloads' );
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            //import member
                $filename = 'Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $file_member = $pathDest.'/'.$filename;
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_member,
                ]);

                $status = $response->getStatusCode();
                if($status == 200){
                    $upload = Excel::load($file_member, function($reader) {
                        $reader->toArray();
                    }, 'ISO-8859-1')->get();

                    if(!empty($upload)){
                        foreach ($upload->toArray() as $key => $value) {
                            $customer_id = preg_replace('/[\x00-\n]/', '', $value['id']);
                            $customer = $modelCustomer->findTixtrackCustomerByCutomerID($customer_id);
                            $newData = [
                                'customer_id' => $customer_id,
                                'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
                                'first_name' => preg_replace('/[\x00-\n]/', '', $value['first_name']),
                                'last_name' => preg_replace('/[\x00-\n]/', '', $value['last_name']),
                                'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
                                'bill_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_1']),
                                'bill_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['bill_to_address_2']),
                                'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['bill_to_city']),
                                'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['bill_to_state']),
                                'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['bill_to_postal_code']),
                                'bill_to_country' => preg_replace('/[\x00-\n]/', '', $value['bill_to_country']),
                                'ship_to_address_1' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_1']),
                                'ship_to_address_2' => preg_replace('/[\x00-\n]/', '', $value['ship_to_address_2']),
                                'ship_to_city' => preg_replace('/[\x00-\n]/', '', $value['ship_to_city']),
                                'ship_to_state' => preg_replace('/[\x00-\n]/', '', $value['ship_to_state']),
                                'ship_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['ship_to_postal_code']),
                                'ship_to_country' => preg_replace('/[\x00-\n]/', '', $value['ship_to_country'])
                            ];
                            if(empty($customer)){
                                TixtrackCustomer::create($newData);
                            }else{
                                TixtrackCustomer::where('customer_id',$customer_id)->update($newData);
                            }
                         
                        }
                    }
                    flash()->success('Import Member success');
                }else{
                    flash()->error('Import Member failed');
                }

                File::delete($pathDest.'/'.$filename);
            //end import member
            
            //import order
                $last = $modelOrder->getLastUpdate();
                if(!empty($last)){
                    $local_created = date('m/d/Y', strtotime($last->local_created));
                    $transaction = [
                        "FilterGroups" => [
                            [
                                "FilterConditions" => 
                                [[
                                    "HasCondition" => true,
                                    "AvailableValues" => [],
                                    "AttributeName" => "LocalCreated",
                                    "ChainOperator" => null,
                                    "ConditionValue" => $local_created,
                                    "AvailableOperators" => ["=",">=","<="],
                                    "OperatorValue" => ">=",
                                    "IsDate" => true,
                                    "IsTime" => false,
                                ]],
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
                    $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                    $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                        'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
                        'Cookie' => $this->cookie(),
                    ]);
                    $response = $client->send($request, [
                        'save_to' => $file_transaction,
                    ]);
                }

                $status = $response->getStatusCode();
                if($status == 200){
                    //return \Response::download($file_transaction)->deleteFileAfterSend(true);
                    $upload = Excel::load($file_transaction, function($reader) {
                        $reader->toArray();
                    }, 'ISO-8859-1')->get();
                    if(!empty($upload)){
                        foreach ($upload->toArray() as $key => $value) {
                            $order_id = preg_replace('/[\x00-\n-\x00"]/', '', $value['orderid']);
                            $section = preg_replace('/[\x00-\n]/', '', $value['section']);
                            $row_section = preg_replace('/[\x00-\n]/', '', $value['row']);
                            $seat_id = preg_replace('/[\x00-\n]/', '', $value['seatid']);
                            $seat_id = (!empty($seat_id)) ? $seat_id : null;
                            $price_level_name = preg_replace('/[\x00-\n-\x00"]/', '', $value['price_level_name']);
                            $local_created = preg_replace('/[\x00-\n]/', '', $value['local_created']);
                            $local_created = date('Y-m-d H:i:s', strtotime($local_created));
                            $local_last_updated = preg_replace('/[\x00-\n]/', '', $value['local_lastupdated']);
                            $local_last_updated = date('Y-m-d H:i:s', strtotime($local_last_updated));
                            $event_date = preg_replace('/[\x00-\n]/', '', $value['eventdate']);
                            $event_date = date('Y-m-d H:i:s', strtotime($event_date));
                            $created = preg_replace('/[\x00-\n]/', '', $value['created']);
                            $created = date('Y-m-d H:i:s', strtotime($created));
                            $last_updated = preg_replace('/[\x00-\n]/', '', $value['lastupdated']);
                            $last_updated = date('Y-m-d H:i:s', strtotime($last_updated));
                            $event_id = preg_replace('/[\x00-\n]/', '', $value['eventid']);
                            $event_id = (!empty($event_id)) ? $event_id : null;
                            $user_id = preg_replace('/[\x00-\n]/', '', $value['userid']);
                            $user_id = (!empty($user_id)) ? $user_id : null;
                            $partner_id = preg_replace('/[\x00-\n]/', '', $value['partnerid']);
                            $partner_id = (!empty($partner_id)) ? $partner_id : null;
                            $item_id = preg_replace('/[\x00-\n]/', '', $value['itemid']);
                            $item_id = (!empty($item_id)) ? $item_id : null;
                            $fee_id = preg_replace('/[\x00-\n]/', '', $value['feeid']);
                            $fee_id = (!empty($fee_id)) ? $fee_id : null;

                            $modelOrder = new TixtrackOrder();
                            $order = $modelOrder->findTixtrackOrder($order_id, $section, $row_section, $seat_id, $price_level_name);
                            
                            
                            
                            $newData = [
                                'order_id' => $order_id,
                                'local_created' => $local_created,
                                'local_last_updated' => $local_last_updated,
                                'first_name' => preg_replace('/[\x00-\n]/', '', $value['firstname']),
                                'last_name' => preg_replace('/[\x00-\n]/', '', $value['lastname']),
                                'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
                                'bill_to_address1' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress1']),
                                'bill_to_address2' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress2']),
                                'bill_to_address3' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress3']),
                                'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['billtocity']),
                                'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['billtostate']),
                                'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['billtopostalcode']),
                                'bill_to_country_code' => preg_replace('/[\x00-\n]/', '', $value['billtocountrycode']),
                                'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
                                'event_id' => $event_id,
                                'event_name' => preg_replace('/[\x00-\n]/', '', $value['eventname']),
                                'event_date' => $event_date,
                                'venue' => preg_replace('/[\x00-\n]/', '', $value['venue']),
                                'ip' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ip']),
                                'order_status' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderstatus']),
                                'price_table_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['pricetablename']),
                                'user_id' => $user_id,
                                'seller_email' => preg_replace('/[\x00-\n-\x00"]/', '', $value['selleremail']),
                                'partner' => preg_replace('/[\x00-\n-\x00"]/', '', $value['partner']),
                                'partner_id' => $partner_id,
                                'total' => preg_replace('/[\x00-\n-\x00"]/', '', $value['total']),
                                'sales_channel' => preg_replace('/[\x00-\n-\x00"]/', '', $value['saleschannel']),
                                'item_id' => $item_id,
                                'order_item_type' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderitemtype']),
                                'fee_id' => $fee_id,
                                'fee_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['feename']),
                                'section' => $section,
                                'row_section' => $row_section,
                                'seat_id' => $seat_id,
                                'price_type' => preg_replace('/[\x00--\x00"]/', '', $value['pricetype']),
                                'price' => preg_replace('/[\x00--\x00"]/', '', $value['price']),
                                'full_price' => preg_replace('/[\x00--\x00"]/', '', $value['fullprice']),
                                'delivery_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['deliverymethodname']),
                                'payment_method_type' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodtype']),
                                'payment_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodname']),
                                'provider_id' => preg_replace('/[\x00--\x00"]/', '', $value['providerid']),
                                'promo_code' => preg_replace('/[\x00--\x00"]/', '', $value['promocode']),
                                'marketing_opt_in1' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin1']),
                                'marketing_opt_in2' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin2']),
                                'created' => $created,
                                'last_updated' => $last_updated,
                                'promotion_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['promotion_name']),
                                'price_level_name' => $price_level_name,
                                'ticket_quantity' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ticketquantity']),
                                'balance' => preg_replace('/[\x00-\n-\x00"]/', '', $value['balance']),
                                'product_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_name']),
                                'product_variant_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_variant_name']),
                            ];
                            if(empty($order)){
                                TixtrackOrder::create($newData);
                            }else{
                                TixtrackOrder::where('order_id', $order_id)
                                    ->where('order_id', $order_id)
                                    ->where('section', $section)
                                    ->where('row_section', $row_section)
                                    ->where('seat_id', $seat_id)
                                    ->where('price_level_name', $price_level_name)->update($newData);
                            }
                         
                        }
                    }
                    File::delete($file_transaction);
                    flash()->success('Import Transaction success!');
                }else{
                    flash()->error('Import Transaction failed');
                }
            //end import order

        }else{
            flash()->error('Change Account/Event failed');
        }

        return redirect()->route('admin-index-tixtrack');
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
        if (!\Session::has('ASPXAUTH')) {
            return redirect()->route('admin-tixtrack-login');
        }
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path( 'temps' );
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            $pathDest2 = public_path( 'downloads' );
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
            if($status == 200){

                // $upload = Excel::load($file_member, function($reader) {
                //     $reader->toArray();
                // }, 'ISO-8859-1')->get();

                // if(!empty($upload)){
                //     foreach ($upload->toArray() as $key => $value) {
                //         $customer_id = preg_replace('/[\x00-\n]/', '', $value['id']);
                //         $modelCustomer = new TixtrackCustomer();
                //         $customer = $modelCustomer->findTixtrackCustomerByCutomerID($customer_id);
                //         $newData/*[]*/ = [
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
                //         if(empty($customer)){
                //             TixtrackCustomer::create($newData);
                //         }else{
                //             TixtrackCustomer::where('customer_id',$customer_id)->update($newData);
                //         }
                     
                //     }
                // }
                flash()->success('Import Member success');
            }else{
                flash()->error('Import Member failed');
            }

            File::delete($pathDest.'/'.$filename);
            //file_delete('downloads/'.$filename, env('FILESYSTEM_DEFAULT'));
            // if($status == 200){
            //     flash()->success('Download Transaction success!');
            //     return \Response::download($file_member)->deleteFileAfterSend(true);
            // }else{
            //     flash()->error('Download Transaction failed');
            // }
            File::copy($file_member, $pathDest2.'/'.$filename);
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
        $pathDest = public_path().'/downloads';
        $file = '/Download_transaction_2016-11-01-08-52-47.csv'; //member gourmet
        // $file2 = '/sample.csv'; //member gourmet
        $file3 = '/nliven_sales_report_undefined_undefined.csv'; //member gourmet

        // $upload = Excel::load($pathDest.$file, function($reader) {
        //     $reader->toArray();
        // }, 'ISO-8859-1')->get();
        $upload = Excel::load($pathDest.$file, function($reader) {
            $reader->toArray();
        })->export('csv');
        dd($upload->toArray()[624]);
                exit;
        if(!empty($upload)){
            foreach ($upload->toArray() as $key => $value) {
                $order_id = preg_replace('/[\x00-\n-\x00"]/', '', $value['orderid']);
                $section = preg_replace('/[\x00-\n]/', '', $value['section']);
                $row_section = preg_replace('/[\x00-\n]/', '', $value['row']);
                $seat_id = preg_replace('/[\x00-\n]/', '', $value['seatid']);
                $seat_id = (!empty($seat_id)) ? $seat_id : null;
                $price_level_name = preg_replace('/[\x00-\n-\x00"]/', '', $value['price_level_name']);
                $local_created = preg_replace('/[\x00-\n]/', '', $value['local_created']);
                $local_created = date('Y-m-d H:i:s', strtotime($local_created));
                $local_last_updated = preg_replace('/[\x00-\n]/', '', $value['local_lastupdated']);
                $local_last_updated = date('Y-m-d H:i:s', strtotime($local_last_updated));
                $event_date = preg_replace('/[\x00-\n]/', '', $value['eventdate']);
                $event_date = date('Y-m-d H:i:s', strtotime($event_date));
                $created = preg_replace('/[\x00-\n]/', '', $value['created']);
                $created = date('Y-m-d H:i:s', strtotime($created));
                $last_updated = preg_replace('/[\x00-\n]/', '', $value['lastupdated']);
                $last_updated = date('Y-m-d H:i:s', strtotime($last_updated));
                $event_id = preg_replace('/[\x00-\n]/', '', $value['eventid']);
                $event_id = (!empty($event_id)) ? $event_id : null;
                $user_id = preg_replace('/[\x00-\n]/', '', $value['userid']);
                $user_id = (!empty($user_id)) ? $user_id : null;
                $partner_id = preg_replace('/[\x00-\n]/', '', $value['partnerid']);
                $partner_id = (!empty($partner_id)) ? $partner_id : null;
                $item_id = preg_replace('/[\x00-\n]/', '', $value['itemid']);
                $item_id = (!empty($item_id)) ? $item_id : null;
                $fee_id = preg_replace('/[\x00-\n]/', '', $value['feeid']);
                $fee_id = (!empty($fee_id)) ? $fee_id : null;

                // $modelOrder = new TixtrackOrder();
                // $order = $modelOrder->findTixtrackOrder($order_id, $section, $row_section, $seat_id, $price_level_name);
                
                //dd($value['billtopostalcode']);
                $newData[] = [
                    'order_id' => $order_id,
                    'local_created' => $local_created,
                    'local_last_updated' => $local_last_updated,
                    'first_name' => preg_replace('/[\x00-\n]/', '', $value['firstname']),
                    'last_name' => preg_replace('/[\x00-\n]/', '', $value['lastname']),
                    'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
                    'bill_to_address1' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress1']),
                    'bill_to_address2' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress2']),
                    'bill_to_address3' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress3']),
                    'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['billtocity']),
                    'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['billtostate']),
                    'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['billtopostalcode']),
                    'bill_to_country_code' => preg_replace('/[\x00-\n]/', '', $value['billtocountrycode']),
                    'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
                    'event_id' => $event_id,
                    'event_name' => preg_replace('/[\x00-\n]/', '', $value['eventname']),
                    'event_date' => $event_date,
                    'venue' => preg_replace('/[\x00-\n]/', '', $value['venue']),
                    'ip' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ip']),
                    'order_status' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderstatus']),
                    'price_table_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['pricetablename']),
                    'user_id' => $user_id,
                    'seller_email' => preg_replace('/[\x00-\n-\x00"]/', '', $value['selleremail']),
                    'partner' => preg_replace('/[\x00-\n-\x00"]/', '', $value['partner']),
                    'partner_id' => $partner_id,
                    'total' => preg_replace('/[\x00-\n-\x00"]/', '', $value['total']),
                    'sales_channel' => preg_replace('/[\x00-\n-\x00"]/', '', $value['saleschannel']),
                    'item_id' => $item_id,
                    'order_item_type' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderitemtype']),
                    'fee_id' => $fee_id,
                    'fee_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['feename']),
                    'section' => $section,
                    'row_section' => $row_section,
                    'seat_id' => $seat_id,
                    'price_type' => preg_replace('/[\x00--\x00"]/', '', $value['pricetype']),
                    'price' => preg_replace('/[\x00--\x00"]/', '', $value['price']),
                    'full_price' => preg_replace('/[\x00--\x00"]/', '', $value['fullprice']),
                    'delivery_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['deliverymethodname']),
                    'payment_method_type' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodtype']),
                    'payment_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodname']),
                    'provider_id' => preg_replace('/[\x00--\x00"]/', '', $value['providerid']),
                    'promo_code' => preg_replace('/[\x00--\x00"]/', '', $value['promocode']),
                    'marketing_opt_in1' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin1']),
                    'marketing_opt_in2' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin2']),
                    'created' => $created,
                    'last_updated' => $last_updated,
                    'promotion_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['promotion_name']),
                    'price_level_name' => $price_level_name,
                    'ticket_quantity' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ticketquantity']),
                    'balance' => preg_replace('/[\x00-\n-\x00"]/', '', $value['balance']),
                    'product_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_name']),
                    'product_variant_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_variant_name']),
                ];
                // if(empty($order)){
                //     TixtrackOrder::create($newData);
                // }else{
                //     TixtrackOrder::where('order_id', $order_id)
                //         ->where('order_id', $order_id)
                //         ->where('section', $section)
                //         ->where('row_section', $row_section)
                //         ->where('seat_id', $seat_id)
                //         ->where('price_level_name', $price_level_name)->update($newData);
                // }
             
            }
            //dd($newData[1]);
            dd($newData[624]);
            if(!empty($insert)){
                //TixtrackCustomer::create($insert);
                //DB::table('tixtrack_customers')->insert($insert);
                dd('Insert Record successfully.');
            }
        }
        exit;
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
                $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                    'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
                    'Cookie' => $this->cookie(),
                ]);
                $response = $client->send($request, [
                    'save_to' => $file_transaction,
                ]);
            }

            $status = $response->getStatusCode();
            if($status == 200){
                flash()->success('Import Transaction success!');
                //return \Response::download($file_transaction)->deleteFileAfterSend(true);
                $upload = Excel::load($file_transaction, function($reader) {
                    $reader->toArray();
                }, 'ISO-8859-1')->get();
                        // exit;
                //dd($upload->toArray());
                if(!empty($upload)){
                    foreach ($upload->toArray() as $key => $value) {
                        $order_id = preg_replace('/[\x00-\n-\x00"]/', '', $value['orderid']);
                        $section = preg_replace('/[\x00-\n]/', '', $value['section']);
                        $row_section = preg_replace('/[\x00-\n]/', '', $value['row']);
                        $seat_id = preg_replace('/[\x00-\n]/', '', $value['seatid']);
                        $seat_id = (!empty($seat_id)) ? $seat_id : null;
                        $price_level_name = preg_replace('/[\x00-\n-\x00"]/', '', $value['price_level_name']);
                        $local_created = preg_replace('/[\x00-\n]/', '', $value['local_created']);
                        $local_created = date('Y-m-d H:i:s', strtotime($local_created));
                        $local_last_updated = preg_replace('/[\x00-\n]/', '', $value['local_lastupdated']);
                        $local_last_updated = date('Y-m-d H:i:s', strtotime($local_last_updated));
                        $event_date = preg_replace('/[\x00-\n]/', '', $value['eventdate']);
                        $event_date = date('Y-m-d H:i:s', strtotime($event_date));
                        $created = preg_replace('/[\x00-\n]/', '', $value['created']);
                        $created = date('Y-m-d H:i:s', strtotime($created));
                        $last_updated = preg_replace('/[\x00-\n]/', '', $value['lastupdated']);
                        $last_updated = date('Y-m-d H:i:s', strtotime($last_updated));
                        $event_id = preg_replace('/[\x00-\n]/', '', $value['eventid']);
                        $event_id = (!empty($event_id)) ? $event_id : null;
                        $user_id = preg_replace('/[\x00-\n]/', '', $value['userid']);
                        $user_id = (!empty($user_id)) ? $user_id : null;
                        $partner_id = preg_replace('/[\x00-\n]/', '', $value['partnerid']);
                        $partner_id = (!empty($partner_id)) ? $partner_id : null;
                        $item_id = preg_replace('/[\x00-\n]/', '', $value['itemid']);
                        $item_id = (!empty($item_id)) ? $item_id : null;
                        $fee_id = preg_replace('/[\x00-\n]/', '', $value['feeid']);
                        $fee_id = (!empty($fee_id)) ? $fee_id : null;

                        $modelOrder = new TixtrackOrder();
                        $order = $modelOrder->findTixtrackOrder($order_id, $section, $row_section, $seat_id, $price_level_name);
                        
                        
                        
                        $newData = [
                            'order_id' => $order_id,
                            'local_created' => $local_created,
                            'local_last_updated' => $local_last_updated,
                            'first_name' => preg_replace('/[\x00-\n]/', '', $value['firstname']),
                            'last_name' => preg_replace('/[\x00-\n]/', '', $value['lastname']),
                            'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
                            'bill_to_address1' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress1']),
                            'bill_to_address2' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress2']),
                            'bill_to_address3' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress3']),
                            'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['billtocity']),
                            'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['billtostate']),
                            'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['billtopostalcode']),
                            'bill_to_country_code' => preg_replace('/[\x00-\n]/', '', $value['billtocountrycode']),
                            'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
                            'event_id' => $event_id,
                            'event_name' => preg_replace('/[\x00-\n]/', '', $value['eventname']),
                            'event_date' => $event_date,
                            'venue' => preg_replace('/[\x00-\n]/', '', $value['venue']),
                            'ip' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ip']),
                            'order_status' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderstatus']),
                            'price_table_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['pricetablename']),
                            'user_id' => $user_id,
                            'seller_email' => preg_replace('/[\x00-\n-\x00"]/', '', $value['selleremail']),
                            'partner' => preg_replace('/[\x00-\n-\x00"]/', '', $value['partner']),
                            'partner_id' => $partner_id,
                            'total' => preg_replace('/[\x00-\n-\x00"]/', '', $value['total']),
                            'sales_channel' => preg_replace('/[\x00-\n-\x00"]/', '', $value['saleschannel']),
                            'item_id' => $item_id,
                            'order_item_type' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderitemtype']),
                            'fee_id' => $fee_id,
                            'fee_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['feename']),
                            'section' => $section,
                            'row_section' => $row_section,
                            'seat_id' => $seat_id,
                            'price_type' => preg_replace('/[\x00--\x00"]/', '', $value['pricetype']),
                            'price' => preg_replace('/[\x00--\x00"]/', '', $value['price']),
                            'full_price' => preg_replace('/[\x00--\x00"]/', '', $value['fullprice']),
                            'delivery_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['deliverymethodname']),
                            'payment_method_type' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodtype']),
                            'payment_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodname']),
                            'provider_id' => preg_replace('/[\x00--\x00"]/', '', $value['providerid']),
                            'promo_code' => preg_replace('/[\x00--\x00"]/', '', $value['promocode']),
                            'marketing_opt_in1' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin1']),
                            'marketing_opt_in2' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin2']),
                            'created' => $created,
                            'last_updated' => $last_updated,
                            'promotion_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['promotion_name']),
                            'price_level_name' => $price_level_name,
                            'ticket_quantity' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ticketquantity']),
                            'balance' => preg_replace('/[\x00-\n-\x00"]/', '', $value['balance']),
                            'product_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_name']),
                            'product_variant_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_variant_name']),
                        ];
                        if(empty($order)){
                            TixtrackOrder::create($newData);
                        }else{
                            TixtrackOrder::where('order_id', $order_id)
                                ->where('order_id', $order_id)
                                ->where('section', $section)
                                ->where('row_section', $row_section)
                                ->where('seat_id', $seat_id)
                                ->where('price_level_name', $price_level_name)->update($newData);
                        }
                     
                    }
                    //dd($newData);
                    // if(!empty($insert)){
                    //     //TixtrackCustomer::create($insert);
                    //     //DB::table('tixtrack_customers')->insert($insert);
                    //     dd('Insert Record successfully.');
                    // }
                }
            }else{
                flash()->error('Import Transaction failed');
            }
            return redirect()->route('admin-tixtrack-download');
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Import Transaction failed');
            return redirect()->route('admin-tixtrack-download');
        
        }
    }
}
