<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAddmisionTypeEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE events 
            ALTER COLUMN admission TYPE text");
        // Schema::table('events', function ($table) {
        //     $sql = 'ALTER TABLE events ALTER COLUMN admission TYPE text';
        //     $table->text('admission')->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE events 
            ALTER COLUMN admission TYPE varchar");
        // Schema::table('events', function ($table) {
        //     $sql = 'ALTER TABLE events ALTER COLUMN admission TYPE character varying(255)';
        //     $table->string('admission')->change();
        // });
    }
}
