<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLoginAccountIdToTixtrackAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tixtrack_accounts', function (Blueprint $table) {
            $table->integer('login_account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tixtrack_accounts', function (Blueprint $table) {
            $table->dropColumn('login_account_id');
        });
    }
}
