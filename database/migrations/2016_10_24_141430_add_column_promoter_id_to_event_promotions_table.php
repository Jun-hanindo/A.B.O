<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPromoterIdToEventPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_promotions', function (Blueprint $table) {
            $table->integer('promoter_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_promotions', function (Blueprint $table) {
            $table->dropColumn('promoter_id');
        });
    }
}
