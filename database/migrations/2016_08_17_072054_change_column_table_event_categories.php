<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTableEventCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_categories', function (Blueprint $table) {
            $table->integer('event_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_categories', function (Blueprint $table) {
            $table->dropColumn('event_id');
            $table->dropColumn('category_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
        });
    }
}
