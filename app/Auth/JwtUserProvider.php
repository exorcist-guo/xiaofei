<?php


namespace App\Auth;


use App\Member;
use Illuminate\Auth\EloquentUserProvider;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $key = config('auth.guards.api.input_key', 'token');

        if (!isset($credentials[$key])) {
            return;
        }
       try{
           $decoded = JWT::decode($credentials[$key], new Key(config('auth.jwt_key'), 'HS256'));
           if(time() > $decoded->exp){
               return;
           }

           $userId = $decoded->userid;
       }catch (\Exception $e){
           return;
       }
        define('USER_MDID',$userId%Member::SUBNUM);
        return $this->retrieveById($userId);
    }



    public static  function getToken($id)
    {
        $host = config('app.url');
        $time = time();
        $exp_time = strtotime('+ 1day');
        $params = [
            'iss' => $host,
            'aud' => $host,
            'iat' => $time,
            'nbf' => $time,
            'exp' => $exp_time,
        ];
        $params['userid'] = $id;
        $token = JWT::encode($params,config('auth.jwt_key'),'HS256');
        return $token;
    }
}
