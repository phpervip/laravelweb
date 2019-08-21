<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_profession', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_name',20)->default('');
            $table->Integer('protype_id')->default(0);
            $table->string('teachers_ids',255)->default('');
            $table->string('description',255)->default('');
            $table->string('cover_img',255)->default('');
            $table->Integer('view_count')->default(0);
            $table->Integer('sort')->default(0);
            $table->Integer('duration')->default(0);
            $table->decimal('price',7,2)->default(0.01);
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
        Schema::dropIfExists('profession');
    }
}
