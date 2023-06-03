<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForumEnableToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('settings') ) {
            Schema::table('settings', function (Blueprint $table) {
                if (!Schema::hasColumn('settings', 'forum_enable'))
                {
                    $table->string('forum_enable')->nullable();
                }
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
        Schema::table('settings', function (Blueprint $table) {

        });
    }
}
