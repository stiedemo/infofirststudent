<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserConfigFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_config_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_form_id');
            $table->string('name');
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('default')->nullable();
            $table->json('config_content')->nullable();
            $table->boolean('required');
            $table->integer('order');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_form_id')->references('id')->on('user_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_config_forms');
    }
}
