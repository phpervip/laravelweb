<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldpassword'     => 'required|min:8',
            'password'        => 'required|string|min:8|confirmed',
        ];
    }

    public function message()
    {
        return [
            'oldpassword.required'  =>'原密码不能为空',
            'oldpassword.min:8'     =>'原密码不正确',
        ];
    }
}
