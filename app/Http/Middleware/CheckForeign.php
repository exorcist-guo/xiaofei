<?php

namespace App\Http\Middleware;

use App\Services\ForeignService;
use App\Traits\ApiResponseTrait;
use Closure;

class CheckForeign
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($locale = $request->header('Language')){
            \App::setLocale($locale);
        }
        $data = $request->input();
        $appid = $request->input('appid','');
        if($appid != config('app.foreign.appid')){
            return $this->error('appid不存在');
        }
        if(config('app.env') != 'local'){
            $is_c = ForeignService::checksign($data);
            if(!$is_c){
                return $this->error('验签失败');
            }
        }

        return $next($request);
    }
}
