<?php

namespace App\Http\Controllers\Backend\Admin\TixTrack;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
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

        $trail = 'System Log';
        $insertTrail = new Trail();
        $insertTrail->insertTrail($trail);
        

        return view('backend.admin.tixtrack.download');
    }

    public function downloadMember(Request $req){
        $param = $req->all();
        
        try{
            //$cookieJar = new \GuzzleHttp\Cookie\CookieJar($this->cookie());
            //$newCookie = \GuzzleHttp\Cookie\SetCookie::fromString($this->cookie());
            //$cookieJar->setCookie($newCookie);
            //dd($cookieJar);
            $client = new Client(); //GuzzleHttp\Client

            $responseLogin = $client->post('https://nliven.co/admin/Account/Login', [
                'allow_redirects' => false,
                //'headers'  => ['content-type' => 'application/x-www-form-urlencoded', 'Accept' => '*/*',],
                'form_params' => [
                    'UserName' => 'asiaboxoffice@hanindogroup.com',
                    'Password' => 'AsiaBoxOffice#55',
                    'RememberMe' => 'false',
                ],
                //'cookies' => $jar,
            ]);

            $loginCookie = $responseLogin->getHeader('set-cookie')[0];
            $jar = new \GuzzleHttp\Cookie\CookieJar();
            $cookie = \GuzzleHttp\Cookie\SetCookie::fromString($loginCookie);
            //$jar->setCookie($loginCookie);

            print_r($cookie); exit;

            if(!empty($param)){
                $response = $client->get('https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'body' => [
                        
                    ],
                    'cookies' => $jar,
                ]
                );
            }else{
                $response = $client->get('https://nliven.co/admin/Customers/Download?objectFilterJSON=null', [
                    'save_to' => 'Download_member_'.time().'.csv',
                    'cookies' => $jar,
                ]
                );
            }

            //return view('backend.tixtrack.download');
            echo $response->getBody();
            //exit;
        
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
            $client = new Client(['cookies' => true]); //GuzzleHttp\Client

            if(!empty($param)){
                $response = $client->get('https://nliven.co/admin/Orders/Download?objectFilterJSON=', [
                    'body' => [
                        
                    ],
                    //'cookies' => true
                ]
                );
            }else{
                $response = $client->get('https://nliven.co/admin/Orders/Download?objectFilterJSON=null', [
                    //'cookies' => true
                ]
                );
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
