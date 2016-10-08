<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSeatColumnToEventScheduleCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_schedule_categories', function (Blueprint $table) {
            $table->string('seat_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_schedule_categories', function (Blueprint $table) {
            $table->dropColumn('seat_color');
        });
    }
}
