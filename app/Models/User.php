<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\User\Address;
use App\Models\User\Sns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'regip','siteid','introduction','member_avatar','email_verified_at','update_time'
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

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'member_email_bind' => 1,
        ])->save();
    }



    public function sns()
    {
        return $this->hasOne(Sns::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

     public function getMemberAvatarUrlAttribute()
    {
        if(Str::startsWith($this->attributes['member_avatar'],['http://','https://'])){
            return $this->attributes['member_avatar'];
        }

        return Storage::disk('public')->url($this->attributes['member_avatar']);
    }
}
