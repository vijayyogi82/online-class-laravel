<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->string('category_id');
            $table->longText('detail')->nullable();
            $table->string('publication')->nullable();
            $table->string('edition')->nullable();
            $table->string('banner')->nullable();
            $table->string('thumbnali')->nullable();
            $table->string('price')->nullable();
            $table->string('free')->default('No');
            $table->string('discount_check')->default('No');
            $table->string('discount_price')->nullable();
            $table->string('files')->nullable();
            $table->string('all_file')->nullable();
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('ebooks');
    }
}
