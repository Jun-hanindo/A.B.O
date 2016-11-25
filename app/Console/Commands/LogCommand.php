<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Log';

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
        \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
           \Log::info([
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time' => $query->time]);
        });

        \Log::info(\Request::all());
        $this->info('Success!');
    }
}
