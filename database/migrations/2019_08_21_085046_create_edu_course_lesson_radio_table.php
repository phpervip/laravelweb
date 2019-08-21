<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduCourseLessonRadioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_course_lesson_radio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('lesson_id')->default(0);
            $table->string('radio_num',30)->nullable();
            $table->string('mobile_pic',10)->default('');
            $table->Integer('duration')->default(0);
            $table->Integer('filesize')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edu_course_lesson__radio');
    }
}
