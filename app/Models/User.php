<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmailContract
{

    use Notifiable,MustVerifyEmailTrait;


     protected $connection = 'mysql_member';
     protected $table = 'member';
    // public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nickname','email', 'encrypt','password','mobile',
        'member_mobile_bind','member_email_bind','regdate',
        'regip','siteid','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 覆盖Laravel中默认的getAuthPassword方法, 返回用户的password和salt字段
     * @return array
     */
    public function getAuthPassword()
    {
        return ['password' => $this->attributes['password'], 'salt' => $this->attributes['encrypt']];
    }
}