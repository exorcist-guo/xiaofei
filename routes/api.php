<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/get/config', 'UserController@getConfig');
Route::post('/user/register', 'UserController@register');
Route::post('/cp', 'UserController@captcha');
Route::post('/send/verify', 'UserController@sendVerifyGuest');
Route::post('/user/login', 'UserController@passwordLogin');
Route::post('/user/forget/password', 'UserController@forgetPassword');

Route::post('/proclamation/list', 'MessageController@proclamationList'); //反馈记录


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/user/info', 'UserController@info');
    Route::post('/user/real/name', 'UserController@realName');
    Route::post('/user/set/trade/password', 'UserController@setTradePassword');
    Route::post('/user/team', 'UserController@team');
    Route::post('/user/promotion', 'UserController@promotion');
    Route::post('/user/send/verify', 'UserController@sendVerify');


    Route::post('/push/integral', 'IntegralController@push'); //推送积分
    Route::post('/integral/withdrawal', 'IntegralController@withdrawal'); //积分提现
    Route::post('/integral/withdrawal/info', 'IntegralController@withdrawalInfo'); //提现信息
    Route::post('/integral/pv/log', 'IntegralController@pvLog'); //营业额记录
    Route::post('/integral/log', 'IntegralController@log'); //积分记录
    Route::post('/integral/transfer', 'IntegralController@transfer'); //积分互转
    Route::post('/index', 'IntegralController@index'); //积分互转
    Route::post('/pv/info', 'IntegralController@pvInfo'); //营业额详情

    Route::post('/bind/mobile', 'UserController@bindMobile'); //营业额详情
    Route::post('/push/dikouquan', 'IntegralController@pushDikouquan'); //推送消费券
    Route::post('/dikouquan/transfer', 'IntegralController@dikouquanTransfer'); //消费券互转
    Route::post('/dikouquan/log', 'IntegralController@dikouquanLog'); //消费券日子

    //问题反馈
    Route::post('/message', 'MessageController@messageInfo'); //问题反馈
    Route::post('/message/submit', 'MessageController@submit'); //提交问题
    Route::post('/message/list', 'MessageController@messageList'); //反馈记录






//    Route::post('/pv/logs', 'UserController@realName');


});

if(config('app.env') === 'local') {
    Route::any('/token/{mobile}', function($mobile){
        $user = \App\Member::where('mobile',$mobile)->first();

        if(!$user) {
            return response()->json(['error' => '找不到用户']);
        }

        $token = \App\Auth\JwtUserProvider::getToken($user->id);

        return response()->json(compact('token'));
    });
}
Route::group(['prefix' => 'foreign', 'middleware' =>  ['foreign']], function() {
    Route::post('/test','ForeignController@test');
    Route::post('/push/pv','ForeignController@pushPv');  //推送营业额
    Route::post('/push/integral','ForeignController@pushIntegral'); //推送积分
    Route::post('/get/push','ForeignController@getOrder');
    Route::post('/push/status','ForeignController@updateStatus');
    Route::post('/check/mobule','ForeignController@checkMobile');
});


