<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\admin\tixtrack\TransactionRequest;
use App\Http\Requests;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Models\TixtrackAccount;
use App\Models\TixtrackLoginAccount;
use App\Models\TixtrackOrder;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use File;
use DB;
use Storage;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Excel;
// use League\Csv\Reader;
// use League\Csv\Writer;
// use Chumper\Zipper\Zipper;
//use GuzzleHttp\Cookie\CookieJar;
//use GuzzleHttp\Cookie\CookieJarInterface;

class TransactionsController extends BaseController
{
    public function __construct(TixtrackOrder $model)
    {
        parent::__construct($model);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {

        $modelAccount = new TixtrackAccount();
        $accounts = $modelAccount->dropdownByLogin(1);
        $data['accounts'] = $accounts;

        $trail['desc'] = 'Update Transaction Tixtrack';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);

        return view('backend.admin.tixtrack.update_transaction', $data);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateData(TransactionRequest $req)
    {
        try{
            $param = $req->all();

            $modelAccount = new TixtrackAccount(); 
            $modelLoginAccount = new TixtrackLoginAccount();
            $loginAccount = $modelLoginAccount->findTixtrackLoginAccountByID(1);

            $username = $loginAccount->email;
            $password = $loginAccount->password;
            $remember = "false";

            $client = new Client();

            $response = $client->post('https://nliven.co/admin/Account/Login', [
                'allow_redirects' => false,
                'form_params' => [
                    'UserName' => $username,
                    'Password' => $password,
                    'RememberMe' => $remember,
                ],
            ]);

            $status = $response->getStatusCode();
            if($status == 302){
                $ASPXAUTH = $response->getHeader('set-cookie')[1];

                $accountID = $param['account'];
                $start_date = date('m/d/Y', strtotime($param['start_date']));
                $end_date = date('m/d/Y', strtotime($param['end_date']));
                $account = $modelAccount->findIdByAccountID($accountID);
                $account_id = $account->id;
                $requestAccount = new GuzzleRequest('PUT', 'https://nliven.co/api/admin/userprofiles/swapaccounts/'.$accountID, [
                    'Cookie' => $ASPXAUTH,
                ]);

                $responseAccount = $client->send($requestAccount);
                $statusAccount = $responseAccount->getStatusCode();
                if($statusAccount == 200){
                    $pathDest = public_path( 'downloads' );
                    if(!File::exists($pathDest)) {
                        File::makeDirectory($pathDest, $mode=0777,true,true);
                    }

                    $filenameTransaction = 'Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                    $file_transaction = $pathDest.'/'.$filenameTransaction;

                    $transaction = [
                        "FilterGroups" => [
                            [
                                "FilterConditions" => [
                                    [
                                        "HasCondition" => true,
                                        "AvailableValues" => [],
                                        "AttributeName" => "LocalCreated",
                                        "ChainOperator" => "AND",
                                        "ConditionValue" => $start_date,
                                        "AvailableOperators" => ["=",">=","<="],
                                        "OperatorValue" => ">=",
                                        "IsDate" => true,
                                        "IsTime" => false,
                                    ],
                                    [
                                        "HasCondition" => true,
                                        "AvailableValues" => [],
                                        "AttributeName" => "LocalCreated",
                                        "ChainOperator" => null,
                                        "ConditionValue" => $end_date,
                                        "AvailableOperators" => ["=",">=","<="],
                                        "OperatorValue" => "<=",
                                        "IsDate" => true,
                                        "IsTime" => false,
                                    ]
                                ],
                                "ChainOperator" => null
                            ]
                        ],
                    ]; 
                    
                    $client = new Client();

                    $requestTransaction = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                        'headers' => ['Content-Type' => 'application/json;charset=UTF-8', 'Accept' => 'application/json'],
                        'Cookie' => $ASPXAUTH,
                    ]);

                    $responseTransaction = $client->send($requestTransaction, [
                        'save_to' => $file_transaction,
                        'json'    => $transaction,
                    ]);

                    $statusTransaction = $responseTransaction->getStatusCode();
                    if($statusTransaction == 200){
                        $this->model->deleteByDate($param['start_date'], $param['end_date'], $account_id);
                        $import = parseCSV($file_transaction, '"', ",", 'ISO-8859-1', 'UTF-8');
                        if(!empty($import)){
                            foreach ($import as $key => $value) {
                                $local_created = date('Y-m-d H:i:s', strtotime($value['local_created']));
                                $local_last_updated = date('Y-m-d H:i:s', strtotime($value['local_lastupdated']));
                                $event_id = (!empty($value['eventid'])) ? $value['eventid'] : null;
                                $event_date = date('Y-m-d H:i:s', strtotime($value['eventdate']));
                                $user_id = (!empty($value['userid'])) ? $value['userid'] : null;
                                $partner_id = (!empty($value['partnerid'])) ? $value['partnerid'] : null;
                                $item_id = (!empty($value['itemid'])) ? $value['itemid'] : null;
                                $fee_id = (!empty($value['feeid'])) ? $value['feeid'] : null;
                                $seat_id = (!empty($value['seatid'])) ? $value['seatid'] : null;
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
                                    'account_id' => $account_id,
                                ];

                                TixtrackOrder::create($newData);
                             
                            }
                        }
                        flash()->success('Download and Update Transaction Account <strong> '.$account->name.' </strong> from <strong>'.$param['start_date'].'</strong> until <strong>'.$param['end_date'].'</strong> success!');

                        File::delete($pathDest.'/'.$filenameTransaction);
                    }else{
                        flash()->error('Download and Update Transaction failed');
                    }
                }else{
                    flash()->error('Change Account/Event failed');
                }
                
            }else{
                
                flash()->error('The user name or password provided is incorrect.');
            }
            
            return redirect()->route('admin-tixtrack-change-account');

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            flash()->error('Update Transaction failed');
            return redirect()->route('admin-tixtrack-change-account');
        
        }
    }
    

}
