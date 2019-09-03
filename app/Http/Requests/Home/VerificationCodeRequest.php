<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class VerificationCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => [
                'required',
                'regex:/^(13[0-9]|14[5-9]|15[0-3,5-9]|16[2,5,6,7]|17[0-8]|18[0-9]|19[1,3,5,8,9])\\d{8}$/',
                'unique:mysql_member.member,username'
            ],
            'captcha' => ['required','captcha'],
        ];
    }

    public function messages()
    {
        return [
            'captcha.required' =>'验证码不能为空',
            'captcha.captcha' => '验证码不正确',
        ];
    }

}
