<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('postjobs')) {
            Schema::create('postjobs', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('companyname');
                $table->string('title');
                $table->string('description',10000);
                $table->string('min_experience');
                $table->string('max_experience');
                $table->string('experience');
                $table->string('years');
                $table->string('location');
                $table->string('requirement');
                $table->string('role');
                $table->string('industry_type');
                $table->string('employment_type');
                $table->string('image');
                $table->string('min_salary');
                $table->string('max_salary');
                $table->string('salary');
                $table->string('skills');
                $table->string('pdf');
                $table->string('message');
                $table->string('varified')->default('0');
                $table->string('status')->default('0');
                $table->string('approved')->nullable();
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
        Schema::dropIfExists('postjobs');
    }
}
