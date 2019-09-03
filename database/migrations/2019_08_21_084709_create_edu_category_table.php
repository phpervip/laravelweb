<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_category', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('parent_id')->default(0);
            $table->string('title',50)->default('');
            $table->Integer('order')->default(0);
            $table->string('desc',255)->default('');
            $table->string('cover',100)->default('');
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
        Schema::dropIfExists('edu_category');
    }
}
