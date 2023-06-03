<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('personalinfos')) {
            Schema::create('personalinfos', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('fname');
                $table->string('lname');
                $table->string('profession');
                $table->string('country');
                $table->string('state');
                $table->string('city');
                $table->string('image');
                $table->string('address');
                $table->string('phone');
                $table->string('email');
                $table->string('skill');
                $table->string('strength',2000);
                $table->string('interest',2000);
                $table->string('objective',2000);
                $table->string('language');
                $table->string('status')->default('0');
                $table->string('verified')->default('0');
                $table->string('message')->nullable();
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalinfos');
    }
}
