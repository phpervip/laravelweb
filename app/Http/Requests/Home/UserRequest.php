<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:mysql_member.member,username,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'member_avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'member_avatar.mimes' =>'头像必须是 jpeg, bmp, png, gif 格式的图片',
            'member_avatar.dimensions' => '图片的清晰度不够，宽和高需要 208px 以上',
            'username.unique' => '用户名已被占用，请重新填写',
            'username.regex' => '用户名只支持英文、数字、横杠和下划线。',
            'username.between' => '用户名必须介于 3 - 25 个字符之间。',
            'username.required' => '用户名不能为空。',
        ];
    }
}
