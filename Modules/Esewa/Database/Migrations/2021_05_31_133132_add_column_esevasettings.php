<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEsevasettings extends Migration
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
                if (!Schema::hasColumn('settings', 'esewa_enable'))
                {
                    $table->boolean('esewa_enable')->default(0);
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
        
    }
}
