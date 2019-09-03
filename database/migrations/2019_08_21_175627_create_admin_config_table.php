<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->text('value');
            $table->text('description')->nullable();
            $table->string('title',50)->nullable();
            $table->Integer('sort')->nullable();
            $table->string('remark',50)->nullable();
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
        Schema::dropIfExists('admin_config');
    }
}
