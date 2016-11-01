<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTixtrackCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tixtrack_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('bill_to_address_1')->nullable();
            $table->text('bill_to_address_2')->nullable();
            $table->string('bill_to_city')->nullable();
            $table->string('bill_to_state')->nullable();
            $table->string('bill_to_postal_code')->nullable();
            $table->string('bill_to_country')->nullable();
            $table->text('ship_to_address_1')->nullable();
            $table->text('ship_to_address_2')->nullable();
            $table->string('ship_to_city')->nullable();
            $table->string('ship_to_state')->nullable();
            $table->string('ship_to_postal_code')->nullable();
            $table->string('ship_to_country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tixtrack_customers');
    }
}
