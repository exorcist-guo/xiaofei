<?php
namespace App\Services;

use \Illuminate\Support\Facades\Redis;

class RrService
{

    protected static $shop_cookie_key = 'shop_cookie_rr';

    public static function getUserInfo($shop_id)
    {
        $method = 'account/get-user-info';

        return self::httpGet($method,$shop_id);
    }

    public static function getAllOrder()
    {
        //https://admin.rrzu.com/order/v3-order-list?page=1&per-page=15&type=all_order&page_id=6629c075c19576027
        //https://admin.rrzu.com/order/v3-order-list?page=2&per-page=15&type=all_order&page_id=6629c075c19576027

    }
    public static function setCookie($shop_id,$value){
        return Redis::hset(self::$shop_cookie_key,$shop_id,$value);
    }

    public static function getCookie($shop_id){
        return  Redis::hget(self::$shop_cookie_key,$shop_id);
    }

    public static function delCookie($shop_id){
       return Redis::hdel(self::$shop_cookie_key,$shop_id);
    }

    public static function httpGet($method,$shop_id)
    {
        $cookie = self::getCookie($shop_id);
        if(empty($cookie)){
            return false;
        }
        $url = 'https://admin.rrzu.com/'.$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //这个是重点,规避ssl的证书检查。
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 跳过host验证

//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt ($ch, CURLOPT_COOKIE , $cookie);
        $result=curl_exec($ch);
        curl_close($ch);
        if($result){
            $result = json_decode($result,true);
        }else{
            self::delCookie($shop_id);
        }
        return $result;
    }


}
