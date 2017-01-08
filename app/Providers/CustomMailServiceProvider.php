<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use App\Customs\MyMailer\CustomTransportManager;

class CustomMailServiceProvider extends MailServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerSwiftTransport(){
        $this->app['swift.transport'] = $this->app->share(function($app)
        {
            return new CustomTransportManager($app);
        });
    }
}
