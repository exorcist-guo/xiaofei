<?php

namespace App\Http\Middleware;

use App\Services\ForeignService;
use App\Traits\ApiResponseTrait;
use Closure;

class LangExamine
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
        return $next($request);
    }
}
