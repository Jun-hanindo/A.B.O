<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,

        // Commands\SendBroadcastDirectory::class,
        \App\Console\Commands\UpdateTixtrack::class,
        //Commands\LogCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('tixtracks:update')
            // ->everyTenMinutes();
            ->cron('*/15 * * * * *')->withoutOverlapping();

        $schedule->call(function () {
            \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
               \Log::info([
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time]);
            });

            \Log::info(\Request::all());
        })->everyMinute();

    }
}
