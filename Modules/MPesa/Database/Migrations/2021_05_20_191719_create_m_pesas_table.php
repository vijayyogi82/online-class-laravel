<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('m_pesas')){
            Schema::create('m_pesas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('checkoutid');
                $table->string('rcode');
                $table->string('rdesc');
                $table->string('txnid')->nullable();
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
        Schema::dropIfExists('m_pesas');
    }
}
