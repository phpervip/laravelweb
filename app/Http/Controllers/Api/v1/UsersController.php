<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->verification_key);

        if(!$verifyData){
            $this->response->error('验证码已失效', 422);
        }

        if(!hash_equals($verifyData['code'], $request->verification_code)){
            // 返回401
            return $this->response->errorUnauthorized('验证码错误');
        }
        // 创建用户
        $encrypt = create_randomstr(6);
        User::create([
            'username' => $request->username,
            'nickname' => $request->username,
            'mobile'   => $verifyData['mobile'],
            'password' => password($request->password, $encrypt),
            'encrypt'  => $encrypt,
            'member_mobile_bind'=>1,
            'regdate'  => time(),
            'regip'    => getIp(),
            'siteid'   => 2,
        ]);

        // 清除验证码缓存
        \Cache::forget($request->verification_key);
        return $this->response->created();

    }
}
