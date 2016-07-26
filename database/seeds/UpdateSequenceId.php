<?php

use Illuminate\Database\Seeder;

class UpdateSequenceId extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SELECT setval(pg_get_serial_sequence('countries', 'id'), max(id)) FROM countries");
        DB::statement("SELECT setval(pg_get_serial_sequence('provinces', 'id'), max(id)) FROM provinces");
        DB::statement("SELECT setval(pg_get_serial_sequence('cities', 'id'), max(id)) FROM cities");
    }
}
