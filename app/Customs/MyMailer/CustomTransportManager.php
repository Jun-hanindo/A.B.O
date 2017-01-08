<?php

namespace App\Customs\MyMailer;

use Illuminate\Mail\TransportManager;
use App\Models\Setting; //my models are located in app\models

class CustomTransportManager extends TransportManager {

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
        $sets = Setting::all();
        $setting = array();
        foreach ($sets as $key => $value) {
            $setting[$value->name] = $value->value;
        }
        $settings = $setting;

        if( $settings){

            $this->app['config']['mail'] = [
                'driver'        => $settings['mail_driver'],
                'host'          => $settings['mail_host'],
                'port'          => $settings['mail_port'],
                'from'          => [
                'address'   => 'no-reply@asiaboxoffice.com',
                'name'      => $settings['mail_name']
                ],
                'encryption'    => $settings['mail_encryption'],
                'username'      => $settings['mail_username'],
                'password'      => $settings['mail_password'],
            ];

            $this->app['config']['services'] = [
                'mailgun' => [
                    'domain' => $settings['mail_domain'],
                    'secret' => $settings['mail_secret'],
                ],

                'mandrill' => [
                    'secret' => $settings['mail_secret'],
                ],

                'ses' => [
                    'key' => $settings['mail_key'],
                    'secret' => $settings['mail_secret'],
                    'region' => (!empty($settings['mail_region'])) ? $settings['mail_region'] : 'us-east-1',
                ],

                'sparkpost' => [
                    'secret' => $settings['mail_secret'],
                ],
            ];
       }

    }
}
