<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('job')->nullable();
            $table->string('type')->nullable();
            $table->decimal('salary', 20, 2)->default(0);
            $table->text('description')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('pre_requisites')->nullable();
            $table->boolean('avaibility')->default(true);
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
        Schema::drop('careers');
    }
}
