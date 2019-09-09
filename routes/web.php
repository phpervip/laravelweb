<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// PC 首页
// Route::get('/', 'PagesController@root')->name('root');

Route::redirect('/','home');

Route::get('home','Home\IndexController@index')->name('index');

// Authentication Routes...
// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// 用户注册相关路由
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('register', 'Auth\RegisterController@showRegistrationFormStepOne')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// 用手机重置密码相关路由
Route::get('password/mobilestepone','Auth\ForgotPasswordController@mobileStepOne')->name('password.mobilestepone');
Route::post('password/mobilestepone','Home\VerificationCodesController@findpwdstore')->name('verificationCodes.findpwdstore');
Route::get('password/mobilesteptwo','Auth\ForgotPasswordController@mobileStepTwo')->name('password.mobilesteptwo');
Route::post('password/mobilesteptwo','Home\VerificationCodesController@findpwdupdate')->name('verificationCodes.findpwdupdate');


// Email Verification Routes...
// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


// 手机注册分两步
Route::get('registerstepone','Auth\RegisterController@showRegistrationFormStepOne')->name('registerstepone');
Route::post('registerstepone','Home\VerificationCodesController@store')->name('verificationCodes.store');
Route::get('registersteptwo','Auth\RegisterController@showRegistrationFormStepTwo')->name('registersteptwo');
Route::post('registersteptwo','Home\VerificationCodesController@register')->name('verificationCodes.register');

// 个人中心
 Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

// 帐号绑定
Route::get('users/{user}/setbindsns','UsersController@setbindsns')->name('users.setbindsns');
// 手机绑定
Route::get('users/{user}/bindmobile','UsersController@mobileshow')->name('users.bindmobileshow');
Route::any('mobile/ajaxsend', 'Home\VerificationCodesController@ajaxsend')->name('mobile.ajaxsend');  // 也用于手机找回密码时发送验证码
Route::post('users/{user}/bindmobileupdate','UsersController@mobileupdate')->name('users.bindmobileupdate');


// 个人中心重设密码
Route::get('users/{user}/passwordreset','UsersController@passwordreset')->name('users.passwordreset');
Route::post('users/{user}/passwordreset','UsersController@passwordupdate')->name('users.passwordupdate');

// 点播课程
Route::get('home/course/list','Home\CourseController@list')->name('course.list');           // 点播列表
Route::get('home/course/detail','Home\CourseController@detail')->name('course');            // 课程详情
Route::get('home/course/lessons','Home\CourseController@lessons')->name('course.lessons');  // 课时列表
Route::get('home/course/play','Home\CourseController@play')->name('course.play');           // 课时播放
Route::get('home/course/order','Home\CourseController@order')->name('course.order');        // 课程下单/报名

// 直播课程
Route::get('home/live/list','Home\LiveController@list')->name('live.list');           // 直播列表
Route::get('home/live/play','Home\LiveController@play')->name('live.play');           // 直播播放


// 资讯
Route::get('home/news/list','Home\NewsController@list')->name('news.list');            // 文章列表
Route::get('home/news/detail','Home\NewsController@detail')->name('news.detail');      // 文章详情



Route::group(['prefix' => 'api/v1'], function () {
  Route::get('user/version',      'Api\v1\UserController@version');
});

Route::group(['prefix' => 'api/v2'], function () {
  Route::get('user/version',      'Api\v2\UserController@version');
});





