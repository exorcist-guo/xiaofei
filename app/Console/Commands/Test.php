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
