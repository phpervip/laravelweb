<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            //'yunpian',
            // 'qcloud',
            'tinree'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        // 'yunpian' => [
        //     'api_key' => env('YUNPIAN_API_KEY'),
        // ],

        // 'qcloud'=>[
        //     'sdk_app_id' => env('QCLOUD_SMS_APP_ID'),   // 要在.env文件配置好相应的值
        //     'app_key' => env('QCLOUD_SMS_APP_KEY'),     // 要在.env文件配置好相应的值
        // ]

        'tinree' => [
            'accesskey' => env('TINREE_ACCESSKEY'),
            'secret' => env('TINREE_SECRET'),
            'sign'=> env('TINREE_SIGN','1900'),                  // 天瑞云国内短信的自定义签名(验证码短信,以下同。)
            'templateId'=> env('TINREE_TEMPLATEID','3303'),      // 天瑞云国内短信的自定义模板
            'intlsign'=> env('TINREE_INTL_SIGN','286'),          // 天瑞云国际短信的自定义签名
            'intl_templateId'=> env('TINREE_INTL_TEMPLATEID','254'), // 天瑞云国际短信的自定义模板

        ],

    ],
];
