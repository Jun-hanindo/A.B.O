<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailabilityHomepageToVisaCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visa_checkouts', function (Blueprint $table) {
            $table->boolean('availability_homepage')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visa_checkouts', function (Blueprint $table) {
             $table->dropColumn('availability_homepage');
        });
    }
}
