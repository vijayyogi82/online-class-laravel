<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('submit_homework')) {
            
            Schema::create('submit_homework', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->integer('homework_id');
                $table->integer('instructor_id')->nullable();
                $table->integer('course_id');
                $table->string('detail')->nullable();
                $table->string('homework')->nullable();
                $table->string('remark')->nullable();
                $table->integer('marks')->nullable();
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
        Schema::dropIfExists('submit_homework');
    }
}