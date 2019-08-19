<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class MobileFindPasswordRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'verification_code'=>'required|min:4|max:4',
            'password'=>'required|string|min:8|confirmed'
        ];
    }

    public function message()
    {
        return [
            'verification_code'=>'验证码不正确',
            'password.min'=>'密码最少8个字符',
            'password.confirmed'=>'两次密码输入不正确'
        ];
    }
}
