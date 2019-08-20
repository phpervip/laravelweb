<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberSnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_member')->create('member_sns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('userid');
            $table->string('qq',20)->default('');
            $table->string('wechat',20)->default('');
            $table->string('weibo',20)->default('');
            $table->string('github',20)->default('');
            $table->string('google',20)->default('');
            $table->string('facebook',20)->default('');
            $table->string('twitter',20)->default('');
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
        Schema::dropIfExists('member_sns');
    }
}
