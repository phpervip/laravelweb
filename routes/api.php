<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api = app('Dingo\Api\Routing\Router');

// 测试版本. .env 中已设置 默认为v1.
// 如果访问v2, 用 postman 在 header 中添加 Accept:application/prs.cgedu2.v2+json
$api->version('v1',function($api){
    $api->get('version',function(){
        return response('this is version v1');
    });
});

$api->version('v2',function($api){
    $api->get('version',function(){
        return response('this is version v2');
    });
});
// -------  end

$api->version('v1',[
    'namespace'=>'App\Http\Controllers\Api\v1'
],function($api){
    // 短信验证码
    $api->post('verificationCodes','verificationCodesController@store')
    ->name('api.v1.verificationCodes.store');
});

$api->version('v2',[
    'namespace'=>'App\Http\Controllers\Api\v2'
],function($api){
    // 短信验证码
    $api->post('verificationCodes','verificationCodesController@store')
    ->name('api.v2.verificationCodes.store');
});



$api->version('v1',[
    'namespace'=>'App\Http\Controllers\Api\v1'
],function($api){
    // 测试 v1
    $api->get('user/version','UserController@version')
    ->name('api.v1.user.store');
});

$api->version('v2',[
    'namespace'=>'App\Http\Controllers\Api\v2'
],function($api){
    // 测试 v2
    $api->get('user/version','UserController@version')
    ->name('api.v2.user.version');
});






