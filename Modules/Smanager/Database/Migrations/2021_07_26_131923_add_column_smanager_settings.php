<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSmanagerSettings extends Migration
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
                if (!Schema::hasColumn('settings', 'smanager_enable'))
                {
                    $table->boolean('smanager_enable')->default(0);
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
        //
    }
}
