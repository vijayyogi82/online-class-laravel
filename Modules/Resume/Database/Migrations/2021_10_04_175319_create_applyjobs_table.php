<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('applyjobs')) {
            Schema::create('applyjobs', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->integer('job_id');
                $table->string('experiense');
                $table->string('years');
                $table->string('skills');
                $table->string('pdf');
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
        Schema::dropIfExists('applyjobs');
    }
}
