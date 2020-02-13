<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stream_title');
            $table->string('stream_name');
            $table->enum('status',[1,2,3]);
            $table->Integer('sort')->default(0);
            $table->Integer('permited_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream');
    }
}
