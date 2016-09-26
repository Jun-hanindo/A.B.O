<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->isLocal()){
            \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
               \Log::info([
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time]);
            });

            \Log::info(\Request::all());
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
