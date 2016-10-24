<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePromoterColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('promotor_id');
            $table->dropColumn('promotor_number');
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('promotor_id')->nullable();
            $table->integer('promotor_number')->nullable();
            $table->dropColumn('promoter_id');
        });
    }
}
