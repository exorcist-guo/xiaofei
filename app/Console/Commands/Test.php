<?php

namespace App\Console\Commands;

use App\Jobs\ChangeOrderJob;
use App\Level;
use App\Member;
use App\PostMember;
use App\Services\ForeignService;
use App\Services\VerifyService;
use App\ShopLevel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use think\api\Client;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }





    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $num = substr('240829100003100',9) + 1;
//        var_dump($num);
//        $key = 'asdasdasd';
//        Redis::set($key,100);
//        Redis::INCR($key);
//        $a = Redis::get($key);
////        $num = 1000;
////        $a = str_pad($num,3,'0',STR_PAD_LEFT);
//        var_dump($a);
//        $a = Redis::expire($key,60);
//        exit;
        Member::createMemberNumber(0);
        exit;
        $mobile = 'test@qq.com';
        $a =  Member::where('is_disabled','<',9)->Where(function ($query)use($mobile){
            $query->where('mobile',$mobile)->orWhere('number',$mobile);
        })->toSql();
        var_dump($a);
        exit;
        VerifyService::sendEmail('qazkdjfhgfd@outlook.com',548987);
        exit;
        \App::setLocale('en');
        $locale = \App::getLocale();
        var_dump($locale);
        var_dump(Member::getNations());

    }
}
