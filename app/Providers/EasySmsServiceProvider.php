<?php

namespace App\Providers;

use Overtrue\EasySms\EasySms;
use Illuminate\Support\ServiceProvider;

class EasySmsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //



    }

        /**
     * Register services.
     *
     * @return void
     */
     public function register()
    {
        $this->app->singleton(EasySms::class, function ($app) {
            return new EasySms(config('easysms'));
        });

        $this->app->alias(EasySms::class, 'easysms');


        // php artisan tinker 中用这一段测试。
        // $sms = app('easysms');
        // try{
        //     $sms->send(18267165221,[
        //         'content' => '【忆莲池】您的验证码是1234。如非本人操作，请忽略本短信',
        //     ]);
        // } catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
        //     $message = $exception->getException('yunpian')->getMessage();
        //     dd($message);
        // }
    }

}
