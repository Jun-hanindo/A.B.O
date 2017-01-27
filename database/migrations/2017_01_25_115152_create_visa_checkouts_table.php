<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_image_mobile')->nullable();
            $table->string('background_color')->nullable();
            $table->string('link')->nullable();
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
        Schema::drop('visa_checkouts');
    }
}
