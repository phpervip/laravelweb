<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Auth;

class EnsureEmailsSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->email) {
             // 根据客户端返回对应的内容
                return $request->expectsJson()
                            ? abort(403, '请先绑定邮箱')
                            : redirect()->route('users.edit',Auth::id());

        }
        return $next($request);
    }
}
