<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTargetUserConfigFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_config_forms', function($table) {
            $table->integer('target')->nullable();
            $table->string('target_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_config_forms', function($table) {
            $table->dropColumn('target');
            $table->dropColumn('target_value');
        });
    }
}
