<?php

namespace App\Providers;

use App\Auth\JwtUserProvider;
use App\Auth\RedisUserProvider;
use App\Services\VerifyService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('auth')->provider('jwt', function ($app, $config) {
            return new JwtUserProvider($app['hash'], $config['model']);
        });
        $this->addAcceptableJsonType();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $table = config('admin.extensions.config.table', 'admin_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }

        Validator::extend('not_exists', function($attribute, $value, $parameters, $validator)
        {
            $query = \DB::table($parameters[0])
                ->where($parameters[1], '=', $value);
            if($parameters[0] == 'members'){
//                $query =$query->where('is_disabled','<',9);
            }
            if(count($parameters) == 5) {
                $query = $query->where($parameters[2], $parameters[3], $parameters[4]);
            }
            if(count($parameters) == 8) {
                $query = $query->where($parameters[2], $parameters[3], $parameters[4])
                    ->where($parameters[5], $parameters[6], $parameters[7]);
            }

            return $query->count()<1;
        });
        Validator::extend('verify_trad_password', function($attribute, $value, $parameters, $validator){
            return Hash::check($value, $parameters[0]);
        });
        Validator::extend('verify_code', function($attribute, $value, $parameters, $validator){
            return VerifyService::verify($parameters[0], $value, $parameters[1]);
        });

    }

    protected function addAcceptableJsonType()
    {
        $this->app->rebinding('request', function ($app, $request) {
            if ($request->is('api/*')) {
                $accept = $request->header('Accept');

                if (! \Str::contains($accept, ['/json', '+json'])) {
                    $accept = rtrim('application/json,'.$accept, ',');

                    $request->headers->set('Accept', $accept);
                    $request->server->set('HTTP_ACCEPT', $accept);
                    $_SERVER['HTTP_ACCEPT'] = $accept;
                }
            }

            if ($request->is('open/*')) {
                $accept = $request->header('Accept');

                if (! \Str::contains($accept, ['/json', '+json'])) {
                    $accept = rtrim('application/json,'.$accept, ',');

                    $request->headers->set('Accept', $accept);
                    $request->server->set('HTTP_ACCEPT', $accept);
                    $_SERVER['HTTP_ACCEPT'] = $accept;
                }
            }
        });
    }
}
