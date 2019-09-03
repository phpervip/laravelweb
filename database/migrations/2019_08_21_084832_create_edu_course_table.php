<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30)->default('');
            $table->string('desc',255)->default('');
            $table->Integer('profession_id')->default(0);
            $table->Integer('classroom_id')->default(0)->comment('班级ID');
            $table->Integer('category_id')->default(0);
            $table->Integer('teacher_id')->default(1)->nullable();
            $table->string('cover',255)->default('');
            $table->string('tags',255)->default('');
            $table->Integer('sort')->default(0);
            $table->enum('status',[1,2,3])->default(1)->comment('1草稿，2已审核，3已发布');
            $table->Integer('create_time')->default(0);
            $table->Integer('update_time')->default(0);
            $table->Integer('create_uid')->default(0);
            $table->Integer('update_uid')->default(0);
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
        Schema::dropIfExists('edu_course');
    }
}
