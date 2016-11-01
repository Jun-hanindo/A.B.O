<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTixtrackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tixtrack_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable();
            $table->timestamp('local_created')->nullable();
            $table->timestamp('local_last_updated')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->text('bill_to_address1')->nullable();
            $table->text('bill_to_address2')->nullable();
            $table->text('bill_to_address3')->nullable();
            $table->string('bill_to_city')->nullable();
            $table->string('bill_to_state')->nullable();
            $table->string('bill_to_postal_code')->nullable();
            $table->string('bill_to_country_code')->nullable();
            $table->string('phone')->nullable();
            $table->integer('event_id')->nullable();
            $table->string('event_name')->nullable();
            $table->timestamp('event_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('ip')->nullable();
            $table->string('order_status')->nullable();
            $table->string('price_table_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('seller_email')->nullable();
            $table->string('partner')->nullable();
            $table->integer('partner_id')->nullable();
            $table->decimal('total', 20, 2)->nullable();
            $table->string('sales_channel')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('order_item_type')->nullable();
            $table->integer('fee_id')->nullable();
            $table->string('fee_name')->nullable();
            $table->string('section')->nullable();
            $table->string('row_section')->nullable();
            $table->integer('seat_id')->nullable();
            $table->string('price_type')->nullable();
            $table->decimal('price', 20, 2)->nullable();
            $table->decimal('full_price', 20, 2)->nullable();
            $table->string('delivery_method_name')->nullable();
            $table->string('payment_method_type')->nullable();
            $table->string('payment_method_name')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('promo_code')->nullable();
            $table->string('marketing_opt_in1')->nullable();
            $table->string('marketing_opt_in2')->nullable();
            $table->timestamp('created')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->string('promotion_name')->nullable();
            $table->string('price_level_name')->nullable();
            $table->integer('ticket_quantity')->nullable();
            $table->decimal('balance', 20, 2)->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_variant_name')->nullable();
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
        Schema::drop('tixtrack_orders');
    }
}
