<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add4ColumnForGoogleAnalyticssAndFacebookPixelToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('ga_tracking_code')->nullable();
            $table->text('ga_conversion_code')->nullable();
            $table->text('fp_tracking_code')->nullable();
            $table->text('fp_conversion_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('ga_tracking_code');
            $table->dropColumn('ga_conversion_code');
            $table->dropColumn('fp_tracking_code');
            $table->dropColumn('fp_conversion_code');
        });
    }
}
