<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('forum_comments')){
            Schema::create('forum_comments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('topic_id');
                $table->integer('parent_comment_id');
                $table->text('description');
                $table->unsignedBigInteger('posted_by_user_id');
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
        Schema::dropIfExists('forum_comments');
    }
}
