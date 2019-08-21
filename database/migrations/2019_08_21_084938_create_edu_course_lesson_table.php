<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduCourseLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_course_lesson', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->default('');
            $table->Integer('course_id')->default(0);
            $table->Integer('video_time')->default(0);
            $table->string('video_url',255)->default('');
            $table->Integer('sort')->default(0);
            $table->string('desc',255)->default('');
            $table->enum('status',[1,2])->default(2);
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
        Schema::dropIfExists('edu_course_lesson');
    }
}
