<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class DownloadController extends BaseController
{
    public function __construct(LogActivity $model)
    {
        parent::__construct($model);
    }

    public function download(){

        $trail = 'System Log';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        

        return view('backend.tixtrack.download');
    }

    public function downloadMember(Request $req){
        $param = $req->all();
        
        try{
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post('https://nliven.co/admin/Account/Login', [
                'body' => [
                    'UserName' => $param['UserName'],
                    'Password' => $param['Password'],
                    'RememberMe' => False,
                ],
                'cookies' => true
            ]
            );

            $status = $response->getStatusCode();

            if($status == 200 || $status == 302){
                return redirect()->route('admin-tixtrack-change-account');
            }else{
                return redirect()->route('admin-tixtrack-login');
            }
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $saveData = $this->model->insertLogActivity($log);

            return redirect()->route('admin-tixtrack-login');
        
        }
    }

    public function downloadTransaction(Request $req){
        $param = $req->all();
        
        try{
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post('https://nliven.co/admin/Account/Login', [
                'body' => [
                    'UserName' => $param['UserName'],
                    'Password' => $param['Password'],
                    'RememberMe' => False,
                ],
                'cookies' => true
            ]
            );

            $status = $response->getStatusCode();

            if($status == 200 || $status == 302){
                return redirect()->route('admin-tixtrack-change-account');
            }else{
                return redirect()->route('admin-tixtrack-login');
            }
        
        //} else {
        } catch (\Exception $e) {

            $log['user_id'] = $this->currentUser->id;
            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $saveData = $this->model->insertLogActivity($log);

            return redirect()->route('admin-tixtrack-login');
        
        }
    }
}
