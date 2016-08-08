<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();;
            $table->text('mrtdirection')->nullable();;
            $table->text('cardirection')->nullable();;
            $table->text('taxidirection')->nullable();;
            $table->decimal('capacity', 20, 0)->default(0);
            $table->string('link_map')->nullable();;
            $table->string('gmap_link')->nullable();;
            $table->boolean('avaibility')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('venues');
    }
}
