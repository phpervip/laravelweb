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

    // 系统配置
    $router->resource('config', ConfigController::class);
    // 专业管理
    $router->resource('profession', ProfessionController::class);
    // 分类管理
    $router->resource('category', CategoryController::class);

    // 课程管理
    $router->resource('course', CourseController::class);
    // 课时管理
    $router->resource('course-lesson', CourseLessonController::class);
    // 资讯管理
    $router->resource('news', NewsController::class);
    // 直播管理
    $router->resource('live', LiveController::class);
    $router->resource('stream', StreamController::class);
    $router->resource('tag', TagController::class);

    $router->resource('china/province' ,China\ProvinceController::class);
    $router->resource('china/city' ,China\CityController::class);
    $router->resource('china/district' ,China\DistrictController::class);

    $router->get('china/cascading-select', 'China\ChinaController@cascading');

    $router->get('api/china/city', 'China\ChinaController@city');
    $router->get('api/china/district', 'China\ChinaController@district');

});


