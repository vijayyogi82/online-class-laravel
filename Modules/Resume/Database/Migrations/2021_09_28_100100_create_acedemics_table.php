<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcedemicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('acedemics')) {
            Schema::create('acedemics', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('course');
                $table->string('school')->nullable();
                $table->integer('marks')->nullable();
                $table->string('yearofpassing')->nullable();
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
        Schema::dropIfExists('acedemics');
    }
}
