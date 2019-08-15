<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    protected $connection = 'mysql_member';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // https://www.cnblogs.com/yiweiyihang/p/8434818.html
        Schema::create('member', function (Blueprint $table) {
                $table->bigIncrements('userid');
                $table->mediumInteger('phpssouid');
                $table->char('username',20)->default('0');
                $table->char('password',32);
                $table->char('encrypt',6)->default('');
                $table->char('nickname',20)->default('');
                $table->string('countrycode',10)->default('86');
                $table->char('mobile',11)->default('');
                $table->tinyInteger('member_mobile_bind');
                $table->char('email',32)->default('');
                $table->tinyInteger('member_email_bind');
                $table->tinyInteger('sex')->comment('1男|2女');
                $table->string('true_name',30)->default('')->comment('真实姓名');
                $table->string('member_areainfo',100)->default('')->comment('真实姓名');
                $table->string('member_avatar',50)->default('');
                $table->unsignedInteger('regdate');
                $table->unsignedInteger('lastdate');
                $table->char('regip',15)->default('');
                $table->char('lastip',15)->default('');
                $table->unsignedSmallInteger('loginnum');
                $table->unsignedTinyInteger('groupid');
                $table->unsignedSmallInteger('areaid');
                $table->decimal('amount', 8, 2)->unsigned();
                $table->unsignedSmallInteger('point');
                $table->unsignedSmallInteger('modelid');
                $table->unsignedTinyInteger('message');
                $table->unsignedTinyInteger('vip');
                $table->unsignedInteger('overduedate');
                $table->unsignedSmallInteger('siteid');
                $table->string('connectid',40)->default('');
                $table->tinyInteger('islock')->comment('1,锁定。2,正常。3,删除。');
                $table->char('from',10)->default('');
                $table->string('member_province',30)->default('');
                $table->string('member_city',30)->default('');
                $table->string('member_area',30)->default('');
                $table->string('member_weibo_id',100)->default('');
                $table->string('member_qq_id',100)->default('');
                $table->string('member_weixin_id',100)->default('');
                $table->Integer('update_time')->comment('信息最近更新时间');
                $table->string('member_mac',100)->default('');
                $table->date('birthday');
                $table->rememberToken();
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
        Schema::dropIfExists('member');
    }
}
