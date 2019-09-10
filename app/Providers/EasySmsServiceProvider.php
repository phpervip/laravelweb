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

        // $sms = app('easysms');
        // try{
        //     $sms->send(18267165221,[
        //         'template' => 388186,    // 你在腾讯云配置的 短信正文的模板ID
        //         'data'=>[                // data数组的内容对应于腾讯云“短信正文“里的变量
        //             1234,                // 变量1
        //         ],
        //     ]);
        // } catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
        //     $message = $exception->getException('qcloud')->getMessage();
        //     dd($message);
        // }

        // $sms = app('easysms');
        // try{
        //     $sms->send('18267165221',[
        //        'content' => "1234",
        //        'data' => ['sign'=>1900,'templateId'=>3303,'intl'=>0]
        //     ]);
        // } catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
        //     $message = $exception->getException('tinree')->getMessage();
        //     dd($message);
        // }


        // $sms = app('easysms');
        // try{
        //     $sms->send('85295810121',[
        //        'content' => "1234",
        //         'data' => ['sign'=>286,'templateId'=>254,'intl'=>1]
        //     ]);
        // } catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
        //     $message = $exception->getException('tinree')->getMessage();
        //     dd($message);
        // }

    }

}
