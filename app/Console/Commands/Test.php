<?php

namespace App\Console\Commands;

use App\Jobs\ChangeOrderJob;
use App\Level;
use App\Member;
use App\Model\LevelLog;
use App\PostMember;
use App\Services\ForeignService;
use App\Services\VerifyService;
use App\ShopLevel;
use Hongyukeji\LaravelTranslate\Translate;
use Hongyukeji\LaravelTranslate\Translators\YouDaoTranslator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
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
        $list = Member::orderBy('id','asc')
            ->where('id',89)
            ->get();
        $levels = Level::getLevels();
        foreach ($list as $user){
            $member = Member::find($user->id);
            Member::checkLevel($member,$levels);
        }

exit;
	$lang_path = base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-CN'.DIRECTORY_SEPARATOR.'auto.php';
        $msg = '交易密码错误';
var_dump($msg &&!Lang::has('auto.'.$msg));
exit;
        $auto = File::get($lang_path);
        if(!Lang::has('auto.'.$msg)){
            $str = "'%s'=>'%s',".PHP_EOL."];";
            $str = sprintf($str,$msg,$msg);
            $auto = str_replace('];', $str, $auto);
            File::put($lang_path,$auto);
        }

//        echo Lang::get('auto.test99');
        var_dump($auto);
        exit;

exit;
        $a = new YouDaoTranslator();
        $b = $a->setSource('zh-CN')->setTarget('en')->translate('你好');
        var_dump($b);
        exit;
        $lang_path = base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh-CN'.DIRECTORY_SEPARATOR.'auto.php';
        $msg = '操作失败';
        $auto = File::get($lang_path);
        if(!Lang::has('auto.'.$msg)){
            $str = "'%s'=>'%s',".PHP_EOL."];";
            $str = sprintf($str,$msg,$msg);
            $auto = str_replace('];', $str, $auto);
            File::put($lang_path,$auto);
        }

//        echo Lang::get('auto.test99');
        var_dump($auto);
        exit;
        $number = '2408252589';
        $m_number = Member::where('number','like',$number.'%')
            ->orderByDesc('id')
            ->value('number');

        if($m_number){
            $num = substr($m_number,10) + 1;

        }
        $num = str_pad($num,3,'0',STR_PAD_LEFT);
        $number .= $num;
        var_dump($num,$number);

        exit;
        $member = Member::whereId(1)->first();

        Member::checkLevel($member);


        exit;
         $a  = Level::getLevels();
//        krsort($a);
        var_dump($a);
        exit;
        $a = array_reverse(explode('/','/8/9/'));
        $a = array_filter($a);


        $member_list = Member::whereIn('id',$a)->get();
        var_dump($member_list);

        exit;



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
        var_dump(99);
        $openid = 777;
        register_shutdown_function(function ($openid){
            //防止同一个用户并发执行
            sleep(15);
           var_dump($openid);
        },$openid);
        var_dump(66666666);
        return 99999;
//        exit;
//        Member::createMemberNumber(0);
//        exit;
//        $mobile = 'test@qq.com';
//        $a =  Member::where('is_disabled','<',9)->Where(function ($query)use($mobile){
//            $query->where('mobile',$mobile)->orWhere('number',$mobile);
//        })->toSql();
//        var_dump($a);
//        exit;
//        VerifyService::sendEmail('qazkdjfhgfd@outlook.com',548987);
//        exit;
//        \App::setLocale('en');
//        $locale = \App::getLocale();
//        var_dump($locale);
//        var_dump(Member::getNations());

    }
}
