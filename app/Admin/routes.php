<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    // $router->get('users', 'UsersController@index');
     // 用户管理
    $router->resource('users', UsersController::class);

    $router->resource('china/province' ,China\ProvinceController::class);
    $router->resource('china/city' ,China\CityController::class);
    $router->resource('china/district' ,China\DistrictController::class);

    $router->get('china/cascading-select', 'China\ChinaController@cascading');

    $router->get('api/china/city', 'China\ChinaController@city');
    $router->get('api/china/district', 'China\ChinaController@district');

});


