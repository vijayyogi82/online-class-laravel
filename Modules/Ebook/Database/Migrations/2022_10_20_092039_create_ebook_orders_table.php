<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbookOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebook_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_id')->nullable();
            $table->integer('ebook_id');
            $table->string('transaction_id')->nullable();
            $table->string('orignal_price')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('coupon')->nullable();
            $table->string('coupon_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('ebook_orders');
    }
}
