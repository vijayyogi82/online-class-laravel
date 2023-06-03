<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('certificate_design')){
            Schema::create('certificate_design', function (Blueprint $table) {
                $table->id();
                $table->string('background_image')->nullable();
                $table->string('background_image_enable')->nullable();
                $table->string('background_color')->nullable();

                $table->string('logo_image')->nullable();
                $table->string('logo_enable')->nullable();
                $table->string('logo_position')->default('center');
                $table->integer('logo_width')->default(150);
                $table->integer('logo_height')->default(100);

                $table->string('border_one')->default(15);
                $table->string('border_one_color')->nullable();
                $table->string('border_one_enable')->nullable();

                $table->string('border_two')->default(15);
                $table->string('border_two_color')->nullable();
                $table->string('border_two_enable')->nullable();
                
                $table->string('width')->nullable();
                $table->string('height')->nullable();

                $table->string('title')->nullable();
                $table->string('title_position')->default('center');
                $table->integer('title_font_size')->default(30);
                $table->string('title_font_color')->nullable();

                $table->text('body')->nullable();
                $table->string('body_position')->default('center');
                $table->integer('body_font_size')->default(10);
                $table->string('body_font_color')->nullable();
                $table->string('body_max_len')->nullable();

                $table->tinyInteger('date_enable')->default(1);
                $table->string('date_position')->default('center');
                $table->integer('date_font_size')->default(30);
                $table->string('date_font_color')->nullable();
                $table->integer('date_format')->default(1);

                $table->string('signature_image')->nullable();
                $table->string('signature_position')->default('center');
                $table->integer('signature_height')->default(100);
                $table->integer('signature_width')->default(150);

                $table->string('name')->nullable();
                $table->string('name_position')->default('center');
                $table->integer('name_font_size')->default(50);
                $table->string('name_font_color')->nullable();

                $table->tinyInteger('for_course')->default(0);
                $table->tinyInteger('for_quiz')->default(0);
                $table->string('percentage')->nullable();

                $table->tinyInteger('default')->default(0);
                $table->string('widget1_enable')->nullable();
                $table->string('widget2_enable')->nullable();
                $table->string('widget3_enable')->nullable();

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
        Schema::dropIfExists('certificate_design');
    }
}
