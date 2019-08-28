<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->string('cover')->nullable();
            $table->Integer('order')->nullable();
            $table->tinyInteger('is_focus')->comment('首页轮播');
            $table->tinyInteger('recommend')->comment('推荐');
            $table->tinyInteger('hot')->comment('热门');
            $table->tinyInteger('new')->comment('最新');
            $table->string('url')->nullable()->comment('跳转网址');
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
        Schema::dropIfExists('news');
    }
}
