<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetadataColumnsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('title_meta_tag')->nullable();
            $table->text('description_meta_tag')->nullable();
            $table->text('keywords_meta_tag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('title_meta_tag');
            $table->dropColumn('description_meta_tag');
            $table->dropColumn('keywords_meta_tag');
        });
    }
}
