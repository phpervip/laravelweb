<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_member')->create('member_address', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->Integer('province_id')->default(0);
            $table->Integer('city_id')->default(0);
            $table->Integer('district_id')->default(0);
            $table->string('address',100)->defalut('');
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
        Schema::dropIfExists('member_address');
    }
}
