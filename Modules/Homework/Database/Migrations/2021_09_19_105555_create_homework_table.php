<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('homework')) {
            
            Schema::create('homework', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('description');
                $table->string('pdf');
                $table->integer('status');
                $table->integer('marks')->nullable();
                $table->integer('user_id');
                $table->integer('course_id');
                $table->integer('compulsory');
                $table->dateTime('endtime');
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
        Schema::dropIfExists('homework');
    }
}