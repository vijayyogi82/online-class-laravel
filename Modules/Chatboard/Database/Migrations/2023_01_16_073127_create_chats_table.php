<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('chats')) {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conv_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('message')->nullable();
            $table->string('type',100)->default('text');
            $table->string('media')->nullable();
            $table->enum('status', ['Not Seen', 'Seen']);
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
        Schema::dropIfExists('chats');
    }
}
