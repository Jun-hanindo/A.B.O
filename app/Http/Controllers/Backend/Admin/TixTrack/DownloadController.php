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
use GuzzleHttp\Cookie\CookieJarInterface;

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
            $client = new Client(['cookies' => true]); //GuzzleHttp\Client

            if(!empty($param)){
                $response = $client->get('https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'body' => [
                        
                    ],
                    //'cookies' => true
                    'cookies' => $cookieJar
                ]
                );
            }else{
                $response = $client->get('https://nliven.co/admin/Customers/Download?objectFilterJSON=', [
                    'save_to' => 'Download_member_'.time().'.csv',
                    //'cookies' => true
                    'cookies' => $cookieJar
                ]
                );
            }

            echo $response;
        
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
                $response = $client->get('https://nliven.co/admin/Orders/Download?objectFilterJSON=', [
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
