<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\TixTrack\LoginRequest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
//use GuzzleHttp\Cookie\CookieJar;
//use GuzzleHttp\Cookie\CookieJarInterface;


class LoginController extends BaseController
{
    public function __construct(LogActivity $model)
    {
        parent::__construct($model);
    }

    public function login(){

        $trail = 'System Log';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        

        return view('backend.tixtrack.login');
    }

    public function postLogin(LoginRequest $req){
        $param = $req->all();
        
        try{
            $cookieJar = new \GuzzleHttp\Cookie\CookieJar();
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post('https://nliven.co/admin/Account/Login', [
                'body' => [
                    'UserName' => $param['UserName'],
                    'Password' => $param['Password'],
                    'RememberMe' => False,
                ],
                'cookies' => $cookieJar,
            ]
            );

            //echo $response;

            $status = $response->getStatusCode();

            if(/*$status == 200 || */$status == 302){
                flash()->success('Login success!');
                return redirect()->route('admin-tixtrack-change-account');
            }else{
                flash()->error('The user name or password provided is incorrect.');
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

    public function changeAccount(){
        // $response = $client->put('http://github.com', [
        //     'cookies' => $cookieJar
        // ]);

        return redirect()->route('admin-tixtrack-download');
    }
}
