<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Requests\Home\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Home\MobileBindRequest;
use Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->member_avatar) {
            $result = $uploader->save($request->member_avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['member_avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }


    public function setbindsns(User $user)
    {
        return view('users.setbindsns', compact('user'));
    }

    public function mobileshow(User $user){
        return view('users.mobileshow', compact('user'));
    }

    public function mobileupdate(MobileBindRequest $request, User $user){
         $verifyData = \Cache::get($request->verification_key);

         //如果数据不存在，说明验证码已经失效。
         if (!$verifyData) {
            session()->flash('danger', '短信验证码已失效');
            return view('users.mobileshow', compact('user'))->with('key', $request->verification_key);
         }

         // 检验前端传过来的验证码是否和缓存中的一致
         if (!hash_equals($verifyData['code'], $request->code)) {
            session()->flash('danger', '短信验证码错误');
            return view('users.mobileshow', compact('user'))->with('key', $request->verification_key);
         }

          // 如果提交的手机号不一致
         if (!hash_equals($verifyData['mobile'], $request->mobile)) {
            session()->flash('danger', '手机号码不一致');
            return view('users.mobileshow', compact('user'))->with('key', $request->verification_key);
         }
         $mobile = User::where('id', '=', Auth::id())->update(
           ['mobile' => $verifyData['mobile']]
         );

         // 清除验证码缓存
         \Cache::forget($request->verification_key);

         return redirect()->route('users.setbindsns', Auth::id())->with('success', '绑定成功');
    }
}
