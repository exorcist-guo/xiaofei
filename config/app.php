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
    'h5url' => env('H5_URL', 'http://q.queryagency.com'),

    'asset_url' => env('ASSET_URL', null),
    'foreign' => [
        'api_url' => 'https://cashier.sandgate.cn/',
        'appid' => '9885489545245',
        'key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCHIYs7uEciDdj6XXZYBRBm3LHk9/d2hoeDsbcf+1J3SAt21ha4OXQxa8RtYVGUYj+UaszLtvf8F+wUBU0yCX73/1pl+Jfkj4QVkZCgSeYjeOBT9TQ8p3V3B3CCmGAxfLFKCldpfYLSrNUg3t1Y+3s3p312YaaezG3RdlOfRWUMerPvYRTi4fa+hWVSK1hMpLKEHNQb8BTELWqaacM6elbnGgtI9C6wmB2IsrNawAQbvBO1oEG0lAFnFTJOoOlTOP3K65gL4pXj6XhBcxm5P//w5GUbFoBww2Jn5G64hiTIMp6s6i8qYcM80DujZ0T1D5fMdoeaN5e0EzES2e5FsqszAgMBAAECggEAeaor8AMEmJabKyAHM0yr7dD6okrYFXEeheX2GOdw4lCNcdtj7U5dXTnISyr6Bn1G/VwDM89zCxiGx6fWTxzZonPYckMWjwTgSYMcEhU3De0BHNaCx7GGQzsBg7OpuCSqgx04gpQsu349DjFaXYle8Ubt4S4elI8+uP6uX5JdXpOzqpCL2e3ccoVG1Vxi47316F50mXmJBL/jETCe3E/b7yGyQ9HTOV6aVumvuz+AMGCCbsdWxdSrrgaC6+G184fv0/RrpgNlmBgcUKRrJHAPaCpSR8mhZvKj986oPI/YMqxEoNhUVMhJivsCD+BSONFrS/A4z0uuqXN7InY6PT7EAQKBgQDICf0lvHQJJ0m/lLYcmWGkNG0L5gBBf+bx7V5d6GTI9YzJ23zg04rnVLYBnfoa4OMtY4Lalq1gpL4VFqTXe9lZWKXvBhbMi/15HcliKde3b+UfSQy0Aui/aXVx0LtAyBatS12SlHC/Br1fJUp+bxgy//73L2E17EwI8OKSbRgnAQKBgQCs7xlexSJvkmI6gYLoPlWky+f87tYRzRvky+JclCpuMtBQkAJVITPBsHWxhDOrgGrGepyelZYZG3Y3pbrK73qhgVxIesIzNMFCniMGCmrKpE4uIa1LsYJTd2pYcYGVVOz1ovzYOicQiS4uUE3uRKEm1qOAazwETlDF1Isb7tjmMwKBgAiYZUg50MKT7ZdNzIVuEcP8fLMGLvyhgkri6Csg0TPRWTtTMwp2DIHkIe3v289L2ncYz4aU8t40NfayAmM/7xbnuDmNCW3AliOeJAkTwzEenbm6adFSTq3q2iEJ1wHxlwfbNSoXNsD+iSSNdaX5IBEQ7uOwJX0rqhi4QQQJrAABAoGAVknz0crx1NQo+WJ4LGQ2HcW02wtde4Jpwa9OIr23skbelORWlZ28ko/3Gf2KPrAUFzdFAQhI3fxK75ddbjcybHX80xmV3zEaoaAAf9og0T5M2E3rh5JqIjW6tajlbNr0ZdjO6yGRLnoUtf1R9Wr/Mj71VHWte8SMHzpfsy9pwOsCgYEAvzv99YR4YEdjZSvZTnU930w6CohW/pZLrSA9HVA/cLaxtklHTL1k+d+ouQxeaaqrx7tjDOHd43POXW0DB77kFnq3xSjlYrJntnTtqRdVIkusGmcwvIUsqq0GD83gV6HiCbre0aXwAVIZSvJq2APwjMj9cIxLgfyG4j/uLN2WVmA=',
        'publicKey' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhyGLO7hHIg3Y+l12WAUQZtyx5Pf3doaHg7G3H/tSd0gLdtYWuDl0MWvEbWFRlGI/lGrMy7b3/BfsFAVNMgl+9/9aZfiX5I+EFZGQoEnmI3jgU/U0PKd1dwdwgphgMXyxSgpXaX2C0qzVIN7dWPt7N6d9dmGmnsxt0XZTn0VlDHqz72EU4uH2voVlUitYTKSyhBzUG/AUxC1qmmnDOnpW5xoLSPQusJgdiLKzWsAEG7wTtaBBtJQBZxUyTqDpUzj9yuuYC+KV4+l4QXMZuT//8ORlGxaAcMNiZ+RuuIYkyDKerOovKmHDPNA7o2dE9Q+XzHaHmjeXtBMxEtnuRbKrMwIDAQAB'
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
