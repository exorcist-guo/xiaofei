<?php

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strtoupper($request->method()) == 'OPTIONS') {
            $response = response('');
        } else {
            $response = $next($request);
        }
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allow_origin = [
            'http://localhost:8000',
            'http://localhost:9095',
            'http://localhost',
            $origin
        ];
//        if (in_array($origin, $allow_origin)) {

        if (1) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin,Language, Token, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN, appId');
            $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }
        return $response;
    }
}
