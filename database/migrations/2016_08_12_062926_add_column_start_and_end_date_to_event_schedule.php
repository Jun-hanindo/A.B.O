<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStartAndEndDateToEventSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_schedules', function (Blueprint $table) {
            $table->string('start_time')->nullable()->after('date_at');
            $table->string('end_time')->nullable()->after('start_date');
            $table->dropColumn('time_period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_schedules', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->string('time_period')->nullable()->after('date_at');
        });
    }
}
