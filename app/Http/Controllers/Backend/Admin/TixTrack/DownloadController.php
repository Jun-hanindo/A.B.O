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
use Chumper\Zipper\Zipper;
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
    //
    
    public function changeAccountAndDownload(Request $req){
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

            return view('backend.admin.tixtrack.download_upload', $data);
        }else{
            return redirect()->route('admin-tixtrack-login');
        }
        
    } 
    
    public function downloadData(Request $req)
    {
        if (!\Session::has('ASPXAUTH')) {
            return redirect()->route('admin-tixtrack-login');
        }
        
        try{

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
                $pathDest = public_path( 'downloads' );
                if(!File::exists($pathDest)) {
                    File::makeDirectory($pathDest, $mode=0777,true,true);
                }

                $filename = 'Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $file_member = $pathDest.'/'.$filename;
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'Cookie' => $this->cookie(),
                ]);
                $responseMember = $client->send($request, [
                    'save_to' => $file_member,
                ]);

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

                    $responseTransaction = $client->send($request, [
                        'save_to' => $file_transaction,
                        'json'    => $transaction,
                    ]);
                }else{
                    $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                    $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                        'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
                        'Cookie' => $this->cookie(),
                    ]);
                    $responseTransaction = $client->send($request, [
                        'save_to' => $file_transaction,
                    ]);
                }

                $statusMember = $responseMember->getStatusCode();
                $statusTransaction = $responseTransaction->getStatusCode();

                if($statusMember == 200 && $statusTransaction == 200){
                    $zipper = new \Chumper\Zipper\Zipper;
                    $zipfile = $pathDest.'/'.'Download_'.date('Y-m-d-H-i-s').'.zip';
                    $zipper->make($zipfile)->add([$file_member, $file_transaction]);
                    $zipper->close();
                }elseif($statusMember == 200 && $statusTransaction != 200){
                    return \Response::download($file_member)->deleteFileAfterSend(true);
                }elseif($statusMember != 200 && $statusTransaction == 200){
                    return \Response::download($file_transaction)->deleteFileAfterSend(true);
                }else{

                }
                    return \Response::download($zipfile)->deleteFileAfterSend(true);
            }

            return redirect()->route('admin-tixtrack-download-import');
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Download failed');
            return redirect()->route('admin-tixtrack-download-import');
        
        }
    }

    public function importData(Request $req){
        if (!\Session::has('ASPXAUTH')) {
            return redirect()->route('admin-tixtrack-login');
        }
        
        try{
            $modelAccount = new TixtrackAccount();
            $modelOrder = new TixtrackOrder();
            $modelCustomer = new TixtrackCustomer();

            $accountID = \Session::get('AccountID');
            if($accountID > 0){
                $accountID = $modelAccount->findIdByAccountID($accountID)->id;
            }else{
                flash()->error('Account is empty!');
                return redirect()->route('admin-tixtrack-download-import');
            }
            if(\Input::hasFile('import_member')){
                $path = \Input::file('import_member')->getRealPath();
                $upload = Excel::load($path, function($reader) {
                    $reader->toArray();
                }, 'ISO-8859-1')->get();

                if(!empty($upload)){
                    foreach ($upload->toArray() as $key => $value) {
                        $customer_id = $value['id'];
                        $customer = $modelCustomer->findTixtrackCustomerByCutomerID($customer_id);
                        $newData = [
                            'account_id' => $accountID,
                            'customer_id' => $customer_id,
                            'email' => $value['email'],
                            'first_name' => $value['first_name'],
                            'last_name' => $value['last_name'],
                            'phone' => $value['phone'],
                            'bill_to_address_1' => $value['bill_to_address_1'],
                            'bill_to_address_2' => $value['bill_to_address_2'],
                            'bill_to_city' => $value['bill_to_city'],
                            'bill_to_state' => $value['bill_to_state'],
                            'bill_to_postal_code' => $value['bill_to_postal_code'],
                            'bill_to_country' => $value['bill_to_country'],
                            'ship_to_address_1' => $value['ship_to_address_1'],
                            'ship_to_address_2' => $value['ship_to_address_2'],
                            'ship_to_city' => $value['ship_to_city'],
                            'ship_to_state' => $value['ship_to_state'],
                            'ship_to_postal_code' => $value['ship_to_postal_code'],
                            'ship_to_country' => $value['ship_to_country']
                        ];
                        if(empty($customer)){
                            TixtrackCustomer::create($newData);
                        }else{
                            TixtrackCustomer::where('customer_id',$customer_id)->update($newData);
                        }
                    }
                }

                \Session::flash('member', 'Import Member success!');
            }

            if(\Input::hasFile('import_transaction')){
                $path = \Input::file('import_transaction')->getRealPath();
                $upload = Excel::load($path, function($reader) {
                    $reader->toArray();
                }, 'ISO-8859-1')->get();

                if(!empty($upload)){
                    foreach ($upload->toArray() as $key => $value) {
                        $order = $modelOrder->getLastOrder();
                        $order_id = $value['orderid'];
                        $local_created = date('Y-m-d H:i:s', strtotime($value['local_created']));
                        $local_last_updated = date('Y-m-d H:i:s', strtotime($value['local_lastupdated']));
                        $event_id = (!empty($value['eventid'])) ? $value['eventid'] : null;
                        $event_date = date('Y-m-d H:i:s', strtotime($value['eventdate']));
                        $user_id = (!empty($value['userid'])) ? $value['userid'] : null;
                        $partner_id = (!empty($$value['partnerid'])) ? $$value['partnerid'] : null;
                        $item_id = (!empty($$value['itemid'])) ? $$value['itemid'] : null;
                        $fee_id = (!empty($$value['feeid'])) ? $$value['feeid'] : null;
                        $seat_id = (!empty($$value['seatid'])) ? $$value['seatid'] : null;
                        $created = date('Y-m-d H:i:s', strtotime($value['created']));
                        $last_updated = date('Y-m-d H:i:s', strtotime($value['lastupdated']));

                        $newData = [
                            'account_id' => $accountID,
                            'order_id' => $order_id,
                            'local_created' => $local_created,
                            'local_last_updated' => $local_last_updated,
                            'first_name' => $value['firstname'],
                            'last_name' => $value['lastname'],
                            'email' => $value['email'],
                            'bill_to_address1' => $value['billtoaddress1'],
                            'bill_to_address2' => $value['billtoaddress2'],
                            'bill_to_address3' => $value['billtoaddress3'],
                            'bill_to_city' => $value['billtocity'],
                            'bill_to_state' => $value['billtostate'],
                            'bill_to_postal_code' => $value['billtopostalcode'],
                            'bill_to_country_code' => $value['billtocountrycode'],
                            'phone' => $value['phone'],
                            'event_id' => $event_id,
                            'event_name' => $value['eventname'],
                            'event_date' => $event_date,
                            'venue' => $value['venue'],
                            'ip' => $value['ip'],
                            'order_status' => $value['orderstatus'],
                            'price_table_name' => $value['pricetablename'],
                            'user_id' => $user_id,
                            'seller_email' => $value['selleremail'],
                            'partner' => $value['partner'],
                            'partner_id' => $partner_id,
                            'total' => $value['total'],
                            'sales_channel' => $value['saleschannel'],
                            'item_id' => $item_id,
                            'order_item_type' => $value['orderitemtype'],
                            'fee_id' => $fee_id,
                            'fee_name' => $value['feename'],
                            'section' => $value['section'],
                            'row_section' => $value['row'],
                            'seat_id' => $seat_id,
                            'price_type' => $value['pricetype'],
                            'price' => $value['price'],
                            'full_price' => $value['fullprice'],
                            'delivery_method_name' => $value['deliverymethodname'],
                            'payment_method_type' => $value['paymentmethodtype'],
                            'payment_method_name' => $value['paymentmethodname'],
                            'provider_id' => $value['providerid'],
                            'promo_code' => $value['promocode'],
                            'marketing_opt_in1' => $value['marketingoptin1'],
                            'marketing_opt_in2' => $value['marketingoptin2'],
                            'created' => $created,
                            'last_updated' => $last_updated,
                            'promotion_name' => $value['promotion_name'],
                            'price_level_name' => $value['price_level_name'],
                            'ticket_quantity' => $value['ticketquantity'],
                            'balance' => $value['balance'],
                            'product_name' => $value['product_name'],
                            'product_variant_name' => $value['product_variant_name'],
                        ];

                        if(empty($order)){
                            TixtrackOrder::create($newData);
                        }else{
                            if($order_id > $order->order_id){
                                TixtrackOrder::create($newData);
                            }
                        }
                     
                    }
                }

                \Session::flash('transaction', 'Import Transaction success!');
            }

            return redirect()->route('admin-tixtrack-download-import');
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            \Session::flash('import_error', 'Import failed');
            return redirect()->route('admin-tixtrack-download-import');
        
        }
    }
    
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

                            $order = $modelOrder->getLastOrder();
                            
                            
                            
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
                                if($order_id > $order->order_id){
                                    TixtrackOrder::create($newData);
                                }
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

            dd($response);
            
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

    public function importTransaction(Request $req){

        try {
            $param = $req->all();
            //dd($param);
            //dd(\Input::file('import_transaction'));
            if(\Input::hasFile('import_transaction')){
                $path = \Input::file('import_transaction')->getRealPath();
                $upload = Excel::load($path, function($reader) {
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

                        $order = $modelOrder->getLastOrder();
                        
                        
                        
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
                            if($order_id > $order->order_id){
                                TixtrackOrder::create($newData);
                            }
                        }
                     
                    }
                }

                flash()->success('Import Transaction success!');
            }else{
                flash()->error('Import Transaction failed');
            }
            return redirect()->route('admin-index-tixtrack');
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertLogActivity($log);

            flash()->error('Import Transaction failed');
            return redirect()->route('admin-index-tixtrack');
        
        }
    }

    public function tesimportTransaction(){
        // testing
        $pathDest = public_path().'/downloads';
        $file = '/Download_transaction_2016-11-02-10-21-37.csv'; //member gourmet
        $file2 = '/nliven_sales_report_361511.csv'; //member gourmet
        $file3 = '/nliven_sales_report_361511361602.csv'; //member gourmet
        $file4 = '/nliven_sales_report_undefined-undefined_4.csv'; //member gourmet

        // $file = fopen($pathDest.$file2,"r");
        // while(! feof($file))
        // {
        //     $text[] = fgetcsv($file);
        // }
        // dd($text[0]);
        // fclose($file);
        // $row = 1;
        // if (($handle = fopen($pathDest.$file3, "r")) !== FALSE) {
        //     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        //         $array[] = $data;
        //         $num = count($data);
        //         echo "<p> $num fields in line $row: <br /></p>\n";
        //         $row++;
        //         for ($c=0; $c < $num; $c++) {
        //             echo $data[$c] . "<br />\n";
        //             //dd($data[$c]);
        //         }
        //     }
        // dd($array[2]);
        //     fclose($handle);
        // }
        // exit;
        $input_encode = 'ISO-8859-1';
        $output_encode = 'UTF-8';
        $enclosure = '"';
        $delimiter = ",";
        $file = file_get_contents($pathDest.$file3);
        $content = iconv($input_encode, $output_encode, $file);
        //$content = str_replace( "\r\n", "\n", $content );
        //$content = str_replace( "\r", "\n", $content );
        $content = preg_replace('/[\x00]/', '', $content);
        //$content = preg_replace('/[\n]/', '\n', $content);
        $row = array( "" );
        $idx = 0;
        $quoted = false;
        //dd(strlen($content));
        for ( $i = 0; $i < strlen($content); $i++ )
        {
            $ch = $content[$i];

            
            if ( $ch == $enclosure )
            {
                $quoted = !$quoted;
            }

            // End of line
            if ( $ch == "\n" && !$quoted )
            {
                // Remove enclosure delimiters
                for ( $k = 0; $k < count($row); $k++ )
                {
                    if ( $row[$k] != "" && $row[$k][0] == $enclosure )
                    {
                        $row[$k] = substr( $row[$k], 1, strlen($row[$k]) - 2 );
                    }
                    $row[$k] = str_replace( str_repeat($enclosure, 2), $enclosure, $row[$k] );
                    $row[$k] = str_replace("\r", "", $row[$k]);
                }
                // Append row into table
                $array[] = $row;
                $row = array( "" );
                $idx = 0;
            }

            // End of field
            else if ( $ch == $delimiter && !$quoted )
            {
                $row[++$idx] = "";
            }

            // Inside the field
            else
            {
                $row[$idx] .= $ch;
            }
        }
        //exit;
        dd($array);
        $names = $array[0];

        //dd($names);
        foreach ($array as $key => $value) {
            if($key > 0){
                //$data[] = $value;
                foreach ($names as $k => $name) {
                    $name = trim($name, " ");
                    $name = strtolower($name);
                    $name = str_replace(' ', '_', $name);
                    $datas[$name] = $value[$k];
                }

                $upload[] = $datas;
            }
        }
                dd($upload);
        // $upload = Excel::load($pathDest.$file3, function($reader) {
        //     $reader->toArray();
        // }, 'ISO-8859-1')->get();
        // dd($upload->toArray());
                //exit;
        if(!empty($upload)){
            foreach ($upload as $key => $value) {
                // $order_id = preg_replace('/[\x00-\n-\x00"]/', '', $value['orderid']);
                // $section = preg_replace('/[\x00-\n]/', '', $value['section']);
                // $row_section = preg_replace('/[\x00-\n]/', '', $value['row']);
                // $seat_id = preg_replace('/[\x00-\n]/', '', $value['seatid']);
                // $seat_id = (!empty($seat_id)) ? $seat_id : null;
                // $price_level_name = preg_replace('/[\x00-\n-\x00"]/', '', $value['price_level_name']);
                // $local_created = preg_replace('/[\x00-\n]/', '', $value['local_created']);
                // $local_created = date('Y-m-d H:i:s', strtotime($local_created));
                // $local_last_updated = preg_replace('/[\x00-\n]/', '', $value['local_lastupdated']);
                // $local_last_updated = date('Y-m-d H:i:s', strtotime($local_last_updated));
                // $event_date = preg_replace('/[\x00-\n]/', '', $value['eventdate']);
                // $event_date = date('Y-m-d H:i:s', strtotime($event_date));
                // $created = preg_replace('/[\x00-\n]/', '', $value['created']);
                // $created = date('Y-m-d H:i:s', strtotime($created));
                // $last_updated = preg_replace('/[\x00-\n]/', '', $value['lastupdated']);
                // $last_updated = date('Y-m-d H:i:s', strtotime($last_updated));
                // $event_id = preg_replace('/[\x00-\n]/', '', $value['eventid']);
                // $event_id = (!empty($event_id)) ? $event_id : null;
                // $user_id = preg_replace('/[\x00-\n]/', '', $value['userid']);
                // $user_id = (!empty($user_id)) ? $user_id : null;
                // $partner_id = preg_replace('/[\x00-\n]/', '', $value['partnerid']);
                // $partner_id = (!empty($partner_id)) ? $partner_id : null;
                // $item_id = preg_replace('/[\x00-\n]/', '', $value['itemid']);
                // $item_id = (!empty($item_id)) ? $item_id : null;
                // $fee_id = preg_replace('/[\x00-\n]/', '', $value['feeid']);
                // $fee_id = (!empty($fee_id)) ? $fee_id : null;

                // $modelOrder = new TixtrackOrder();
                // $order = $modelOrder->findTixtrackOrder($order_id, $section, $row_section, $seat_id, $price_level_name);
                
                //dd($value['billtopostalcode']);
                // $newData = [
                //     'order_id' => $order_id,
                //     'local_created' => $local_created,
                //     'local_last_updated' => $local_last_updated,
                //     'first_name' => preg_replace('/[\x00-\n]/', '', $value['firstname']),
                //     'last_name' => preg_replace('/[\x00-\n]/', '', $value['lastname']),
                //     'email' => preg_replace('/[\x00-\n]/', '', $value['email']),
                //     'bill_to_address1' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress1']),
                //     'bill_to_address2' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress2']),
                //     'bill_to_address3' => preg_replace('/[\x00-\n]/', '', $value['billtoaddress3']),
                //     'bill_to_city' => preg_replace('/[\x00-\n]/', '', $value['billtocity']),
                //     'bill_to_state' => preg_replace('/[\x00-\n]/', '', $value['billtostate']),
                //     'bill_to_postal_code' => preg_replace('/[\x00-\n]/', '', $value['billtopostalcode']),
                //     'bill_to_country_code' => preg_replace('/[\x00-\n]/', '', $value['billtocountrycode']),
                //     'phone' => preg_replace('/[\x00-\n]/', '', $value['phone']),
                //     'event_id' => $event_id,
                //     'event_name' => preg_replace('/[\x00-\n]/', '', $value['eventname']),
                //     'event_date' => $event_date,
                //     'venue' => preg_replace('/[\x00-\n]/', '', $value['venue']),
                //     'ip' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ip']),
                //     'order_status' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderstatus']),
                //     'price_table_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['pricetablename']),
                //     'user_id' => $user_id,
                //     'seller_email' => preg_replace('/[\x00-\n-\x00"]/', '', $value['selleremail']),
                //     'partner' => preg_replace('/[\x00-\n-\x00"]/', '', $value['partner']),
                //     'partner_id' => $partner_id,
                //     'total' => preg_replace('/[\x00-\n-\x00"]/', '', $value['total']),
                //     'sales_channel' => preg_replace('/[\x00-\n-\x00"]/', '', $value['saleschannel']),
                //     'item_id' => $item_id,
                //     'order_item_type' => preg_replace('/[\x00-\n-\x00"]/', '', $value['orderitemtype']),
                //     'fee_id' => $fee_id,
                //     'fee_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['feename']),
                //     'section' => $section,
                //     'row_section' => $row_section,
                //     'seat_id' => $seat_id,
                //     'price_type' => preg_replace('/[\x00--\x00"]/', '', $value['pricetype']),
                //     'price' => preg_replace('/[\x00--\x00"]/', '', $value['price']),
                //     'full_price' => preg_replace('/[\x00--\x00"]/', '', $value['fullprice']),
                //     'delivery_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['deliverymethodname']),
                //     'payment_method_type' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodtype']),
                //     'payment_method_name' => preg_replace('/[\x00--\x00"]/', '', $value['paymentmethodname']),
                //     'provider_id' => preg_replace('/[\x00--\x00"]/', '', $value['providerid']),
                //     'promo_code' => preg_replace('/[\x00--\x00"]/', '', $value['promocode']),
                //     'marketing_opt_in1' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin1']),
                //     'marketing_opt_in2' => preg_replace('/[\x00-\n-\x00"]/', '', $value['marketingoptin2']),
                //     'created' => $created,
                //     'last_updated' => $last_updated,
                //     'promotion_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['promotion_name']),
                //     'price_level_name' => $price_level_name,
                //     'ticket_quantity' => preg_replace('/[\x00-\n-\x00"]/', '', $value['ticketquantity']),
                //     'balance' => preg_replace('/[\x00-\n-\x00"]/', '', $value['balance']),
                //     'product_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_name']),
                //     'product_variant_name' => preg_replace('/[\x00-\n-\x00"]/', '', $value['product_variant_name']),
                // ];
                // 
                $local_created = date('Y-m-d H:i:s', strtotime($value['local_created']));
                $local_last_updated = date('Y-m-d H:i:s', strtotime($value['local_lastupdated']));
                $event_id = (!empty($value['eventid'])) ? $value['eventid'] : null;
                $event_date = date('Y-m-d H:i:s', strtotime($value['eventdate']));
                $user_id = (!empty($value['userid'])) ? $value['userid'] : null;
                $partner_id = (!empty($$value['partnerid'])) ? $$value['partnerid'] : null;
                $item_id = (!empty($$value['itemid'])) ? $$value['itemid'] : null;
                $fee_id = (!empty($$value['feeid'])) ? $$value['feeid'] : null;
                $seat_id = (!empty($$value['seatid'])) ? $$value['seatid'] : null;
                $created = date('Y-m-d H:i:s', strtotime($value['created']));
                $last_updated = date('Y-m-d H:i:s', strtotime($value['lastupdated']));

                $newData = [
                    'order_id' => $value['orderid'],
                    'local_created' => $local_created,
                    'local_last_updated' => $local_last_updated,
                    'first_name' => $value['firstname'],
                    'last_name' => $value['lastname'],
                    'email' => $value['email'],
                    'bill_to_address1' => $value['billtoaddress1'],
                    'bill_to_address2' => $value['billtoaddress2'],
                    'bill_to_address3' => $value['billtoaddress3'],
                    'bill_to_city' => $value['billtocity'],
                    'bill_to_state' => $value['billtostate'],
                    'bill_to_postal_code' => $value['billtopostalcode'],
                    'bill_to_country_code' => $value['billtocountrycode'],
                    'phone' => $value['phone'],
                    'event_id' => $event_id,
                    'event_name' => $value['eventname'],
                    'event_date' => $event_date,
                    'venue' => $value['venue'],
                    'ip' => $value['ip'],
                    'order_status' => $value['orderstatus'],
                    'price_table_name' => $value['pricetablename'],
                    'user_id' => $user_id,
                    'seller_email' => $value['selleremail'],
                    'partner' => $value['partner'],
                    'partner_id' => $partner_id,
                    'total' => $value['total'],
                    'sales_channel' => $value['saleschannel'],
                    'item_id' => $item_id,
                    'order_item_type' => $value['orderitemtype'],
                    'fee_id' => $fee_id,
                    'fee_name' => $value['feename'],
                    'section' => $value['section'],
                    'row_section' => $value['row'],
                    'seat_id' => $seat_id,
                    'price_type' => $value['pricetype'],
                    'price' => $value['price'],
                    'full_price' => $value['fullprice'],
                    'delivery_method_name' => $value['deliverymethodname'],
                    'payment_method_type' => $value['paymentmethodtype'],
                    'payment_method_name' => $value['paymentmethodname'],
                    'provider_id' => $value['providerid'],
                    'promo_code' => $value['promocode'],
                    'marketing_opt_in1' => $value['marketingoptin1'],
                    'marketing_opt_in2' => $value['marketingoptin2'],
                    'created' => $created,
                    'last_updated' => $last_updated,
                    'promotion_name' => $value['promotion_name'],
                    'price_level_name' => $value['price_level_name'],
                    'ticket_quantity' => $value['ticketquantity'],
                    'balance' => $value['balance'],
                    'product_name' => $value['product_name'],
                    'product_variant_name' => $value['product_variant_name'],
                ];
                //if(empty($order)){
                    TixtrackOrder::create($newData);
                // }else{
                //     TixtrackOrder::where('order_id', $order_id)
                //         ->where('order_id', $order_id)
                //         ->where('section', $section)
                //         ->where('row_section', $row_section)
                //         ->where('seat_id', $seat_id)
                //         ->where('price_level_name', $price_level_name)->update($newData);
                // }
             
            }
            //dd($newData);
            //dd($newData[624]);
        }
        // end testing
    }

    public function downloadTransaction(Request $req){

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
                    'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
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
