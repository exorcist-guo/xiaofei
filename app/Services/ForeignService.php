<?php

namespace App\Services;

class ForeignService
{


    public static function checksign($data){

        $check_sing = $data['sign'];
        $params = $data;
        $config = config('app.foreign');
        unset($params['sign']);
        ksort($params);
        $jsmparams = '';
        foreach ($params as $key => $val) {
            if($val){
                if ($jsmparams) {
                    $jsmparams .= '&' . $key . '=' . $val;
                } else {
                    $jsmparams = $key . '=' . $val;
                }
            }

        }
        return self::verify($jsmparams,$check_sing,$config['publicKey']);

    }


    public static function getSign($content, $privateKey){
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($privateKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        $key = openssl_get_privatekey($privateKey);
        openssl_sign($content, $signature, $key, OPENSSL_ALGO_SHA256);
        openssl_free_key($key);
        $sign = base64_encode($signature);
        return $sign;
    }

    public static function verify($content, $sign, $publicKey){
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($publicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        $key = openssl_get_publickey($publicKey);
        $ok = openssl_verify($content,base64_decode($sign), $key,'SHA256');
        openssl_free_key($key);

        return $ok;
    }

    public static function httpPost($method,$data){
        $url = '';
        $config = config('app.foreign');
        $params['appid'] = $config['appid'];
        ksort($params);
        $jsmparams = '';
        foreach ($params as $key =>$val){
            if($jsmparams){
                $jsmparams .=  '&'.$key.'='.$val;
            }else{
                $jsmparams = $key.'='.$val;
            }
        }

        $sign = self::getSign($jsmparams,$config['key']);

        $params['sign'] = $sign;
        $params = json_encode($params,JSON_UNESCAPED_UNICODE);
        var_dump($params);exit;
        $herd = [
            'Content-Type: application/json',
            'Accept:application/json',
            'Content-Length:' . strlen($params),
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_MAXREDIRS,10);
        curl_setopt($curl, CURLOPT_TIMEOUT,30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$herd);
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_POST,true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$params);
        $data = curl_exec($curl);

        $data = json_decode($data,true);
        curl_close($curl);
        return $data;
    }
}
