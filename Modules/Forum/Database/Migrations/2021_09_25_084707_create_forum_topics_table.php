<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('forum_topics')){
            Schema::create('forum_topics', function (Blueprint $table) {
                $table->id();
                $table->string('topic_title');
                $table->text('description');
                $table->text('photo')->nullable();
                $table->unsignedBigInteger('created_by_user_id');
                $table->unsignedBigInteger('category_id');
                $table->string('display_order');
                $table->tinyInteger('display_in_listing');
                $table->string('slug');
                $table->enum('status',[1,0])->comment = '1:active, 0:In-Active';
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
        Schema::dropIfExists('forum_topics');
    }
}
