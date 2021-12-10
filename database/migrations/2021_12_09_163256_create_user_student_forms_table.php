<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStudentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_student_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_form_id');
            $table->timestamps();
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
        Schema::dropIfExists('user_student_forms');
    }
}
