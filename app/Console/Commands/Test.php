<?php

namespace App\Console\Commands;

use App\Jobs\ChangeOrderJob;
use App\Level;
use App\Member;
use App\Model\BonusSettlement;
use App\Model\LevelLog;
use App\Model\ShopNumber;
use App\PostMember;
use App\PvOrder;
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



    public function detectAndConvertToUtf8($string) {
        $encodings = ['UTF-8', 'GBK', 'BIG5', 'ISO-8859-1'];
        $detectedEncoding = mb_detect_encoding($string, $encodings, true);

        if ($detectedEncoding && $detectedEncoding !== 'UTF-8') {
            var_dump(666);
            return mb_convert_encoding($string, 'UTF-8', $detectedEncoding);
        }
        return $string; // 如果已经是 UTF-8 或无法检测，则返回原字符串
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = Member::whereId(131)->first();
        if($user->path){
            $path = $user->path . $user->id.'/';
        }else{
            $path = '/'.$user->id.'/';
        }
        $all_divvy_pv = Member::where('path', 'like', "{$path}%")->sum('divvy_pv');
        var_dump($all_divvy_pv, $user->divvy_pv , $user->divvy_pv_t);
        $all_divvy_pv = $all_divvy_pv + $user->divvy_pv + $user->divvy_pv_t;

        var_dump($all_divvy_pv);
        exit;
        $this->cleanAllData();


        exit;
        $pv_order = PvOrder::where('id',170)->first();
        $user = Member::whereId($pv_order->member_id)->first();
        $user->is_chuxiao = 1;
        $user->chuxiao_time = $pv_order->created_at;
        $user->save();
        var_dump($user->id);

        exit;
        $s = $this->detectAndConvertToUtf8('这是编码问题,请修改');
        var_dump($s);
        $a = new YouDaoTranslator();
        $b = $a->setSource('zh-CN')->setTarget('en')->translate($s);
        var_dump($b);
        exit;
        $list = Member::orderBy('id','asc')
            ->where('shop_level','>',0)
            ->get();

        foreach ($list as $user){
            $log = LevelLog::where('type',2)->where('member_id',$user->id)
                ->orderByDesc('id')
                ->first();
            if($log){
                $user->shop_level_time = $log->created_at;
                $user->save();
            }
        }

        exit;


        $bonus_settlement_id = 39;
        $is_open_chuxiao = 1;
        $bonus_settlement = BonusSettlement::whereId(39)->first();
        $levels = Level::getLevels();
        $shop_levels = ShopLevel::getLevels();
        PvOrder::where('status',2)
            ->where('id',128)
            ->orderBy('id', 'asc')
            ->chunk(1000, function ($pv_orders)use($levels,$shop_levels,$bonus_settlement_id,$is_open_chuxiao) {

                foreach ($pv_orders as $pv_order){
                    $user = Member::whereId($pv_order->member_id)->first();
                    if(!$user){
                        continue;
                    }
                    $a = new BonusSettlementCommand();
                    $a->fuwu($user,$pv_order,$bonus_settlement_id,$shop_levels);
                }

            });

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

    public function cleanAllData()
    {
        $data = [
            'bonus_settlement' => 0,
            'change_order' => 0,
            'dikouquan_log' => 0,
            'divvy_pv_logs' => 0,
            'failed_jobs' => 0,
            'integral_logs' => 0,
            'integral_logs_' => ['t'=>19,'id'=>0],
            'integral_order' => 0,
            'level_log' => 0,
            'login_log' => 0,
            'member_examine' => 0,
            'members' => 0,
            'message'  => 0,
            'migrations' => 0,
            'post_member' => 0,
            'post_save_member' =>  0,
            'push_dikouquan' => 0,
            'push_integral' => 0,
            'push_order' => 0,
            'pv_logs' => 0,
            'pv_logs_' => ['t'=>19,'id'=>0],
            'pv_order' => 0,
            'settlement_log' => 0,
            'settlement_member' => 0,
            'shop_number' => 0,
            'transfer' => 0,
            'withdrawal' => 0,
        ];

        foreach ($data as $key => $value){
            if(is_array($value)){
                for($i=0;$i<=$value['t'];$i++){
                    DB::table($key.$i)->where('id','>',$value['id'])->delete();
                }
            }else{
                DB::table($key)->where('id','>',$value)->delete();

            }


        }
        DB::table('shop_number')->insert([
            'id' => 1,
            'number' => '1000',
            'status' => 1,
            'member_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


    }
}
