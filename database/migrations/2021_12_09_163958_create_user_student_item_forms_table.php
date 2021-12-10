<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStudentItemFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_student_item_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_student_form_id');
            $table->unsignedInteger('user_config_form_id');
            $table->string('value')->nullable();
            $table->timestamps();
            $table->foreign('user_student_form_id')->references('id')->on('user_student_forms');
            $table->foreign('user_config_form_id')->references('id')->on('user_config_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_student_item_forms');
    }
}
