<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),
    'foreign' => [
        'api_url' => 'https://cashier.sandgate.cn/',
        'appid' => '9885489545245',
        'key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCosyAXs3mnotJA0eAReP3JAhUT4BBlCt7uGBaE+NxM1nUNyE4RjOc8wFxq76FdP+owtPaQbZ3ibd7nRSKFYENuQpEsZcdWzYauxTLnttGTMDurhL7CkkITviH58fK358Ssbc3e6GaLbmacCGBAifbAOAwcRGu9PlnpdOo1tSEQd7TiBMqbSg2/UR+rGa/FsZZ+R1auTzlWP/fSm54ghrRkuSmXTzb/kkjlE9S9W7le1cuUpatEAEkjOIQkyNuP+QsjjeAqdLNAJ7t7PdGq1SvOy/+dNAnEHiPenBLwmVmsmJdMqMRTHZDuniEGi+AKw7r7XBJ6qP2f44OGV50Ldh4LAgMBAAECggEATAgXQbdY8A25Fw/AHf/a2Zo/p6qHmRKSMNrYY2vJ1jOdo+2QCeboXQARZvzDTES/Jt6YdbWBwAhmuvL0wQoGug30Yf8pHV0aA3DLJZXG1MCbVA1K8GR8tWsu4viBvRMPF+uRKpKxjMvgIRjBULUdabqY8rB/olYUrdxMppIQ6dtdjYcbKKbcD8pp5HMyQQGrJ6XWM2gJxmrghPQBEs9LeJ7Msp6qxJHHSM1Vs22XqhKK9E0AvBEvHeBnQ4IpGPD5RcGh5wq63LmBz48JKIEGXN8tReJ2xSoI2QOpGkd8mQA5hjlLNUvVMfbi3oPPabzwNsS37D0ai3RynuXA83pGgQKBgQDk9I+5aYFvb2sPKI9K4DDRyoxch4wy/mVQw6r4lYkrgaJBGYbdpd4NveS451b5HKZ25DqOV9rZRzFaKQrSr/rP8OTMTbMIjkYKBbr7Nmj1bydnUxCYkpezHUwNhZtjA3sA0SMMmZm6RAfZXQssVM1hf17HzM4ZbRnJk6LfPtptSwKBgQC8oHqmyC8BWqIS6XG66mjEjU8o6IV1+K8KUL6nlNDPYJYwvJKTM4MXA9Eghucb1oU67FfUEPTCzZWHS0kGDHItg8+xRK2cqKyIg9141AB5DyNm4vnuBSstAz9YO4ja04rkhpvvtYB0QNSW0LK4bfqhqpw9gWjybMeThhqkSjxaQQKBgQDdm8IJiw+XltafQ3j+1mUqisy1OxX+vbG/LMUt+z9b9wvfyx95JnT6BBWAy5qpYIvXhC0RXgQcTwZ76EHrkB5KazZqccKaw2sThFxpj06kUURohEQKCcn/upnEdM/kVJgYQFWWeo4LdpHKWH7aF/L7LdfFuHy8q5dMPzRktWeiZQKBgCgLRZ6MlvYJoKi1KHDO/MjlWu3LVzHxRm/BLohzHlU4Iwpbrh5T7DuBku791KhjRUt6Czc5Fk0Yyeq7/9ep4r9o4Tm348eDQ4WDwQu6rhMFNLXN79MpA759lwALO4WBLVZQgWBFPuzvKnKOAbMHnhKeHqcsBvSYRVI7QQKpw+BBAoGBANR0e9VGF+lKZSMKqbGFdnVkRsQTAH77hZ8Zh9W7LrJSim56C88tcLrPhxE43C9SApzCXPay83jDrJ5pFId/JvZ0dOwLw2cZokt0HoXiQYbQpJxBDdbCt2ja3TClgltyb+rsm0nHJJmlUBOXxiiyNYH6KuwkPO6EPPjJnHqmWWn1',
        'publicKey' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA7fnG/T5w7iQJGtYd/iXYTZK3LJ0nNwKAavOAT4hmCBGWXd7MzUciNVZhDsL06/cmXAPmx2obTZXaMc75z3W6yWNwJexJcAU7vVupXjHnXL0+V33GypqcEOjyHrgP7rZYeKMF/Fl7Cs553p2sWEI/qMD1/uVZBkHyS3UeAi5uY+lhM8Ycls/TAAf7SEOJRoxNiMsRWHOMtp6v8VZLQZwZW/FsPaLS+Wy7glVMHWTQn3iWf7yJ0T8w0sZXPHNj2VR8QAZasNBhEzWhjr9hxqWwE1TV5SceLK3SWxs7yjJzMP60u6MmS6ELVwJpOD1fHxU1MsePr7z5aWqb52Nu4ZOgVQIDAQAB'
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Shanghai',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'zh-CN',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Mews\Captcha\CaptchaServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,


    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Captcha' => Mews\Captcha\Facades\Captcha::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,


    ],

];
