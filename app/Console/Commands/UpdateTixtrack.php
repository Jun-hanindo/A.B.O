<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use App\Models\TixtrackAccount;
use App\Models\TixtrackCustomer;
use App\Models\TixtrackOrder;
use App\Models\TixtrackLoginAccount;
use File;
use DB;
use Storage;
use Excel;

class UpdateTixtrack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tixtracks:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and update data tixtrack';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar; 

        $modelCustomer = new TixtrackCustomer();
        $modelOrder = new TixtrackOrder();
        $modelAccount = new TixtrackAccount();
        $modelLoginAccount = new TixtrackLoginAccount();

        $loginAccounts = $modelLoginAccount->getTixtrackLoginAccount();
        if(!empty($loginAccounts)){
            foreach ($loginAccounts as $k => $val) {
                $username = $val->email;
                $password = $val->password;
                // $username = "asiaboxoffice@hanindogroup.com";
                // $password = "AsiaBoxOffice#55";
                $remember = "false";

                $client = new Client();
                $response = $client->post('https://nliven.co/admin/Account/Login', [
                    'allow_redirects' => false,
                    //'headers'  => ['content-type' => 'application/x-www-form-urlencoded', 'Accept' => '*/*',],
                    'form_params' => [
                        'UserName' => $username,
                        'Password' => $password,
                        'RememberMe' => $remember,
                    ],
                ]);

                $status = $response->getStatusCode();

                if($status == 302){
                    $this->info('Login Tixtrack success!');

                    $ASPXAUTH = $response->getHeader('set-cookie')[1];
                    $accounts = $modelAccount->getTixtrack();
                    if(!empty($accounts)){
                        foreach ($accounts as $key => $value){
                            $accountID = $value->account_id;
                            $client = new Client();

                            $requestAccount = new GuzzleRequest('PUT', 'https://nliven.co/api/admin/userprofiles/swapaccounts/'.$accountID, [
                                'Cookie' => $ASPXAUTH,
                            ]);
                            $responseAccount = $client->send($requestAccount);

                            $statusAccount = $responseAccount->getStatusCode();
                            if($statusAccount == 200){
                                $this->info('Change Account/Event success!');
                                $pathDest = public_path( 'downloads' );
                                if(!File::exists($pathDest)) {
                                    File::makeDirectory($pathDest, $mode=0777,true,true);
                                }
                                //chmod(__DIR__."/".$pathDest, 0777);
                                $account = $modelAccount->findIdByAccountID($accountID);
                                if(!empty($account)){
                                    $account_id = $account->id;

                                    //download member
                                        $lastMember = $modelCustomer->getLastCustomerAccount($account_id);
                                        $filenameMember = 'Download_member_'.date('Y-m-d-H-i-s').'.csv';
                                        $file_member = $pathDest.'/'.$filenameMember;
                                        if(!empty($lastMember)){
                                            $member = [
                                                "ID" => 0,
                                                "Name" => "",
                                                "Save" => false,
                                                "FilterGroups" => [
                                                    [
                                                        "FilterConditions" => [
                                                            [
                                                                "HasCondition" => true,
                                                                "AvailableValues" => [],
                                                                "AttributeName" => "UserId",
                                                                "ChainOperator" => null,
                                                                "ConditionValue" => $lastMember->customer_id,
                                                                "AvailableOperators" => ["=",">=","<="],
                                                                "OperatorValue" => ">=",
                                                                "IsDate" => false,
                                                                "IsTime" => false,
                                                            ],
                                                        ],
                                                        "ChainOperator" => null
                                                    ]
                                                ],
                                            ]; 
                                            $member = json_encode($member);

                                            $requestMember = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON='.$member, [
                                                'Cookie' => $ASPXAUTH,
                                            ]);
                                            $responseMember = $client->send($requestMember, [
                                                'save_to' => $file_member,
                                            ]);
                                        }else{
                                            $requestMember = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                                                'Cookie' => $ASPXAUTH,
                                            ]);
                                            $responseMember = $client->send($requestMember, [
                                                'save_to' => $file_member,
                                            ]);
                                        }

                                        $statusMember = $responseMember->getStatusCode();
                                    //end download member
                                    
                                    //download transaction
                                        $filenameTransaction = 'Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                                        $file_transaction = $pathDest.'/'.$filenameTransaction;
                                        $lastTransaction = $modelOrder->getLastOrderAccount($account_id);
                                        if(!empty($lastTransaction)){
                                            $transaction = [
                                                "FilterGroups" => [
                                                    [
                                                        "FilterConditions" => 
                                                        [[
                                                            "HasCondition" => true,
                                                            "AvailableValues" => [],
                                                            "AttributeName" => "ID",
                                                            "ChainOperator" => null,
                                                            "ConditionValue" => $lastTransaction->order_id,
                                                            "AvailableOperators" => ["=",">=","<="],
                                                            "OperatorValue" => ">=",
                                                            "IsDate" => false,
                                                            "IsTime" => false,
                                                        ]],
                                                        "ChainOperator" => null
                                                    ]
                                                ],
                                            ]; 

                                            $requestTransaction = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                                                'headers' => ['Content-Type' => 'application/json;charset=UTF-8', 'Accept' => 'application/json'],
                                                'Cookie' => $ASPXAUTH,
                                            ]);

                                            $responseTransaction = $client->send($requestTransaction, [
                                                'save_to' => $file_transaction,
                                                'json'    => $transaction,
                                            ]);
                                        }else{
                                            $requestTransaction = new GuzzleRequest('POST', 'https://nliven.co/api/admin/orders/download', [
                                                'headers' => ['Content-Type' => 'application/json;charset=UTF-8'],
                                                'Cookie' => $ASPXAUTH,
                                            ]);
                                            $responseTransaction = $client->send($requestTransaction, [
                                                'save_to' => $file_transaction,
                                            ]);
                                        }

                                        $statusTransaction = $responseTransaction->getStatusCode();
                                    //end download transaction

                                    //import member
                                        if($statusMember == 200){
                                            $import = parseCSV($file_member, '"', ",", 'ISO-8859-1', 'UTF-8');
                                            if(!empty($import)){
                                                foreach ($import as $key => $value) {
                                                    $newData = [
                                                        'customer_id' => $value['id'],
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
                                                        'ship_to_country' => $value['ship_to_country'],
                                                        'account_id' => $account_id,
                                                    ];
                                                    if(empty($lastMember) || $value['id'] != $lastMember->customer_id){
                                                        TixtrackCustomer::create($newData);
                                                    }
                                                 
                                                }
                                            }
                                            $this->info('Download and Import Member success!');
                                        }else{
                                            $this->error('Download and Import Member failed');
                                        }
                                    //end import member

                                    //import order
                                        if($statusTransaction == 200){
                                            $import = parseCSV($file_transaction, '"', ",", 'ISO-8859-1', 'UTF-8');
                                            if(!empty($import)){
                                                foreach ($import as $key => $value) {
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
                                                        'account_id' => $account_id,
                                                    ];

                                                    if(empty($lastTransaction) || $value['orderid'] != $lastTransaction->order_id){
                                                        TixtrackOrder::create($newData);
                                                    }
                                                 
                                                }
                                            }
                                            $this->info('Download and Import Transaction success!');
                                        }else{
                                            $this->error('Download and Import Transaction failed');
                                        }
                                    //end import order
                                }
                            }else{
                                $this->error('Change Account/Event failed');
                            }
                        }
                    }
                }else{
                    $this->error('Login Tixtrack failed');
                }
            }
        }
    }
}
