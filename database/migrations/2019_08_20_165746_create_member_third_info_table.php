<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberThirdInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_member')->create('member_third_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',45)->default('');
            $table->string('uid',100)->default('');
            $table->string('province',45)->default('');
            $table->string('city',45)->default('');
            $table->string('figureurl',200)->default('');
            $table->string('gender',20)->default('');
            $table->string('mobile',20)->default('');
            $table->string('nickname',45)->default('');
            $table->Integer('member_id')->default(0);
            $table->string('country_code',10)->default('');
            $table->string('member_mac',45)->default('');
            $table->Integer('update_time')->default(0);
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
        Schema::dropIfExists('member_third_info');
    }
}
