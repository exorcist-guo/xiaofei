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

        return self::sendSms($mobile, $verify,$type);


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

    public static function sendEmail($email, $code)
    {
        try {
            \Mail::raw("您的验证码是：$code", function ($message) use ($code, $email) {
                \Log::channel('verify')->info('', compact('email','code'));
                $a = $message->to($email)->subject(config('mail.from.name') . '验证码');
                var_dump($a);
            });
            var_dump(777);
        } catch (\Exception $e) {
            var_dump(8888);
            var_dump($e->getMessage());
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
