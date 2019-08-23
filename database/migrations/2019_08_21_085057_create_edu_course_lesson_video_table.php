<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduCourseLessonVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_course_lesson_video', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('lesson_id')->default(0);
            $table->string('video_quality',50)->default('');
            $table->string('video_num',50)->nullable();
            $table->string('file_type',50)->nullable();
            $table->string('m3u8_quality',50)->nullable();
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
        Schema::dropIfExists('edu_course_lesson_vide');
    }
}
