<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // https://www.cnblogs.com/yiweiyihang/p/8434818.html
        Schema::connection("mysql_member")->create('member', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->char('username',20)->default('0');
                $table->char('password',32);
                $table->char('encrypt',6)->default('');
                $table->char('nickname',20)->default('');
                $table->string('countrycode',10)->default('86');
                $table->char('mobile',11)->default('');
                $table->tinyInteger('member_mobile_bind')->default(0);
                $table->char('email',32)->default('');
                $table->tinyInteger('member_email_bind')->default(0);
                $table->tinyInteger('sex')->comment('1男|2女')->default(1);
                $table->string('true_name',30)->default('')->comment('真实姓名');
                $table->string('member_areainfo',100)->default('');
                $table->string('member_avatar',200)->default('');
                $table->unsignedInteger('regdate')->default(0);
                $table->unsignedInteger('lastdate')->default(0);
                $table->char('regip',15)->default('');
                $table->char('lastip',15)->default('');
                $table->unsignedSmallInteger('loginnum')->default(0);
                $table->unsignedSmallInteger('siteid')->default(1);
                $table->string('connectid',40)->default('');
                $table->tinyInteger('islock')->comment('1,锁定。2,正常。3,删除。')->default(1);
                $table->char('from',10)->default('');
                $table->string('member_province',30)->default('');
                $table->string('member_city',30)->default('');
                $table->string('member_area',30)->default('');
                $table->string('member_weibo_id',100)->default('');
                $table->string('member_qq_id',100)->default('');
                $table->string('member_weixin_id',100)->default('');
                $table->Integer('update_time')->comment('信息最近更新时间')->default(0);
                $table->string('member_mac',100)->default('');
                $table->date('birthday')->nullable();
                // 下面是新增的
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
                $table->enum('type',[1,2])->default(1)->comment('1学生，2老师');
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
        Schema::connection("mysql_member")->dropIfExists('member');
    }
}
