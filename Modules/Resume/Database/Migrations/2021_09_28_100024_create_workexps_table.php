<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkexpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('workexps')) {
            Schema::create('workexps', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('jobtitle');
                $table->string('employer');
                $table->string('city');
                $table->string('state');
                $table->string('startdate');
                $table->string('enddate')->nullable();

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
        Schema::dropIfExists('workexps');
    }
}
