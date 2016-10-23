<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use File;
//use GuzzleHttp\Cookie\CookieJar;
//use GuzzleHttp\Cookie\CookieJarInterface;

class DownloadController extends BaseController
{
    public function __construct(LogActivity $model)
    {
        parent::__construct($model);
    }

    public function cookie(){
        if (\Session::has('ASPXAUTH')) {
            $cookie = \Session::get('ASPXAUTH'); 
            return $cookie;
        }else{
            return redirect()->route('admin-tixtrack-login');
        }
    }

    public function download(){

        if (\Session::has('ASPXAUTH')) {

            $trail = 'Tixtrack download';
            $insertTrail = new Trail();
            $insertTrail->insertTrail($trail);

            return view('backend.admin.tixtrack.download');
        }else{
            return redirect()->route('admin-tixtrack-login');
        }
    }

    public function downloadMember(Request $req){
        $param = $req->all();
        
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

                $data = [
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
                $data = json_encode($data);
                //$data = urlencode (json_encode($data));
                //dd($data);
        
                $file_member = $pathDest.'/Download_member_'.date('Y-m-d-H-i-s').'.csv';
                $request = new GuzzleRequest('GET', 'https://nliven.co/admin/Customers/Download?objectFilterJSON='.$data, [
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
            return view('backend.admin.tixtrack.download');
            //exit;
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $saveData = $this->model->insertLogActivity($log);

            flash()->error('Download Member failed');
            return view('backend.admin.tixtrack.download');
        
        }
    }

    public function downloadTransaction(Request $req){
        $param = $req->all();
        
        try{
            $client = new Client(); //GuzzleHttp\Client

            $pathDest = public_path().'/donwloads';
            if(!File::exists($pathDest)) {
                File::makeDirectory($pathDest, $mode=0777,true,true);
            }

            $param = [
                // "ID" => 0,
                // "Name" => "",
                // "Save" => false,
                "FilterGroups" => [
                    [
                        "FilterConditions" => [
                            [
                                "HasCondition" => true,
                                "Available Values" => [],
                                "AttributeName" => "LocalCreated",
                                "ChainOperator" => null,
                                "ConditionValue" => "10/21/2016 12:00 AM",
                                "AvailableOperators" => ["=",">=","<="],
                                "OperatorValue" => ">=",
                                "IsDate" => false,
                                "IsTime" => false,
                            ]
                        ],
                        "ChainOperator" => null
                    ]
                ],
            ];
            //$data = json_encode($param);
            $data = $param;

            if(!empty($param)){
                $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i-s').'.csv';
                $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/Orders/Download?objectFilterJSON=', [
                    'json' => $data,
                    'headers' => ['Accept' => 'application/json'],
                    'Cookie' => $this->cookie(),
                ]);

                //print_r($request);exit;
                $response = $client->send($request, [
                    'save_to' => $file_transaction,
                ]);
            }else{
                $file_transaction = $pathDest.'/Download_transaction_'.date('Y-m-d-H-i').'.csv';
                $request = new GuzzleRequest('POST', 'https://nliven.co/api/admin/Orders/Download?objectFilterJSON=', [
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
            return view('backend.admin.tixtrack.download');
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $saveData = $this->model->insertLogActivity($log);

            flash()->error('Download Transaction failed');
            return view('backend.admin.tixtrack.download');
        
        }
    }
}
