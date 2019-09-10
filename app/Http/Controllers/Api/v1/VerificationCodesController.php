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

        // 非生产环境下不真实发短信
         if(!app()->environment('production')){
             $code = '1234';
        }else{
           // 云片短信成功。
           /* try{
                $result = $easySms->send($mobile,[
                    'content' => "【忆莲池】您的验证码是1234。如非本人操作，请忽略本短信"
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception)
                {
                $message = $exception->getException('yunpian')->getMessage();
                return $this->response->errorInternal($message ?:'短信发送异常');
            }*/

            // 天瑞云短信调试成功。
            // 查看 mobile 如果为86开头的，则走国内通道，否则国际通道。
            $countrycode ='86';
            if($countrycode =='86'){
                $sign       = config('easysms.gateways.tinree.sign');
                $templateId = config ('easysms.gateways.tinree.templateId');
                $intl       = 0;
            }else{
                $sign       = config('easysms.gateways.tinree.intl_sign');
                $templateId = config('easysms.gateways.tinree.intl_templateId');
                $intl       = 1;
            }

            $data = [
                'sign'      =>$sign,
                'templateId'=>$templateId,
                'intl'      =>$intl,
            ];

            try{
                $result = $easySms->send($mobile,[
                    'content'   => $code,
                    'data'      => $data,
                ]);

            }catch(\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
                $message = $exception->getException('tinree')->getMessage();
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
