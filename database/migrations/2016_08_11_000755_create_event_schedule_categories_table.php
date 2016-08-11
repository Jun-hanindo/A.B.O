<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventScheduleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_schedule_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_schedule_id')->nullable();
            $table->text('additional_info')->nullable();
            $table->decimal('price', 20, 2)->default(0);
            $table->string('price_cat')->nullable();
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
        Schema::drop('event_schedule_categories');
    }
}
