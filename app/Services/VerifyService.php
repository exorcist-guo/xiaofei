<?php


namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Overtrue\EasySms\PhoneNumber;
use App\Services\Curl;
use think\api\Client;

class VerifyService
{

    public static function  getClientIp()
    {
        if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function send($mobile, $verify, $type = 'password', $country_code = '86')
    {
        $key = sprintf('verify_%s_%s', $type, $mobile);

        Redis::set($key, $verify, 'ex', 60 * 5);
        \Log::channel('verify')->info(__METHOD__, compact('mobile', 'verify'));

        if(\App::environment('local')){
            return true;
        }

        if(strpos($mobile, '@') == false) {
            return true;
//            $tpl = config('sms.gateways.aliyun.template_code');
//
//            return self::sendSms($mobile, $verify,$type);

        } else {

            return self::sendEmail($mobile, $verify,$type);
        }




    }

    public static function verify($mobile, $code, $type = 'password')
    {
        $code = strtoupper($code);

        $savedCode = Redis::get(sprintf('verify_%s_%s', $type, $mobile));

        self::delete($mobile, $type);

        if(\App::environment('local')){
            return true;
        }

        return $savedCode == $code;
    }

    public static function get($mobile, $type)
    {
        return Redis::get(sprintf('verify_%s_%s', $type, $mobile));
    }

    public static function delete($mobile, $type = 'password')
    {
        return Redis::del(sprintf('verify_%s_%s', $type, $mobile));
    }

    public static function sendEmail($email, $code,$type)
    {
        try {
            \Mail::raw(__('message.verify_code')."：$code", function ($message) use ($code, $email,$type) {
                \Log::channel('verify')->info('', compact('email','code'));
                $message->to($email)->subject(config('mail.from.name') . __('message.code'));
            });

        } catch (\Exception $e) {
            \Log::channel('verify')->error($e, compact('email'));
        }

        return true;
    }

    public static function sendSms($mobile, $code,$type)
    {

        try {

            $client = new Client("f648bf38-c2b6-4112-93b0-cd966ff03ba3");
            $result = $client->smsSend()
                ->withSignId('ELe3Vpd6')
                ->withTemplateId('zPdy2ReQ')
                ->withPhone($mobile)
                ->withParams('{"code": "'.$code.'"}')
                ->request();
            \Log::channel('verify')->info('发送成功'.$type.$mobile,$result);
            if(isset($result['code']) && $result['code'] == 0){
                return true;
            }else{
                return false;
            }


        } catch (\Exception $e) {
            \Log::channel('verify')->error($e, compact('mobile', 'code', 'type'));
        }

        return false;
    }
}
