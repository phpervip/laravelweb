<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->default('');
            $table->tinyInteger('hot')->default(0);
            $table->tinyInteger('new')->default(0);
            $table->tinyInteger('recommend')->default(0);
            $table->string('options',255)->default('');
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
        Schema::dropIfExists('tags');
    }
}
