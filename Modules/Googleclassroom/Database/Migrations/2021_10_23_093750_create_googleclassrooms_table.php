<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleclassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('googleclassrooms')){
            Schema::create('googleclassrooms', function (Blueprint $table) {
                $table->bigInteger('id', true)->unsigned();
                $table->integer('user_id')->nullable();
                $table->string('owner_id', 191);
                $table->integer('course_id')->nullable();
                $table->string('classroom_cource_id', 191);
                $table->string('cource_title')->nullable();
                $table->string('cource_description')->nullable();
                $table->string('cource_url', 191);
                $table->string('drive_url', 191);
                $table->string('link_by')->nullable();
                $table->string('classroom_cource_enrollment_code')->nullable();
                $table->string('image', 191)->nullable();
                $table->string('cource_state')->nullable();
                $table->string('start_time')->nullable();
                $table->string('end_time')->nullable();
                $table->string('duration')->nullable();
                $table->string('timezone')->nullable();
                $table->boolean('status');
                $table->string('join_url', 191);
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
        Schema::dropIfExists('googleclassrooms');
    }
}
