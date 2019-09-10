<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        // return $this->response->array(['test_message' => 'v1 store verification code']);
        $mobile = $request->mobile;
        // 生成4位随机数，左侧补0
        $code = str_pad(random_int(1,9999),4,0,STR_PAD_LEFT);

        if(!app()->environment('production')){
            $code = '1234';
        }else{
            try{
                $result = $easySms->send($mobile,[
                    'content' => "【忆莲池】您的验证码是1234。如非本人操作，请忽略本短信"
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception)
                {
                $message = $exception->getException('yunpian')->getMessage();
                return $this->response->errorInternal($message ?:'短信发送异常');
            }
        }


        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);

        // 缓存验证骊， 10分钟过期
        \Cache::put($key,['mobile'=>$mobile, 'code'=>$code], $expiredAt);

        return $this->response->array([
            'key'=>$key,
            'expired_at'=>$expiredAt->toDateTimeString(),
        ])->setStatusCode(201);

    }
}
