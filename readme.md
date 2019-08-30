<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects。

## 安装方法

git clone https://github.com/phpervip/laravelweb
cp .env.example .env
修改.env  填自己的
composer update (本地)
composer install(服务器)
(如果报错，可能是php限制执行某些函数，修改php.ini)
php artisan key:generate
chmod -R 777 storage
php artisan storage:link

前台用户密码：12345678
后台用户密码：admin, admin


本项目：
后台使用 laravel-admin
http://laravel-admin.org/
前台使用 bootstrap
https://v4.bootcss.com/docs/4.3/examples/
