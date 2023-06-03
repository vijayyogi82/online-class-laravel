<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('forums_categories')){
            Schema::create('forums_categories', function (Blueprint $table) {
                $table->id();
                $table->string('category_name')->nullable();
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
        Schema::dropIfExists('forums_categories');
    }
}
