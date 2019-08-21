<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_live', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->default('');
            $table->Integer('profession_id');
            $table->Integer('stream_id');
            $table->string('cover')->nullable();
            $table->Integer('sort')->default(0);
            $table->string('desc',255)->default('');
            $table->timestamp('begin_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('video_url',255)->nullable;
            $table->enum('status',[1,2])->default(1);
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
        Schema::dropIfExists('edu_live');
    }
}
