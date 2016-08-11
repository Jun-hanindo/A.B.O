<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('venue_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('featured_image1')->nullable();
            $table->string('featured_image2')->nullable();
            $table->string('featured_image3')->nullable();
            $table->string('buylink')->nullable();
            $table->string('admission')->nullable();
            $table->boolean('avaibility')->default(true);
            $table->boolean('event_type')->default(true);
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
        Schema::drop('events');
    }
}
