<?php

namespace App\Console\Commands;

use App\IntegralLogs;
use App\Level;
use App\Member;
use App\Model\BonusSettlement;
use App\Model\NewPerformance;
use App\PvOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class BonusSettlementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:bonus-settlement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '结算奖金';

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
        $reids_lock = 'command:bonus-settlement';
        $is_lock = Redis::get($reids_lock);
        if($is_lock){
            var_dump('已有进程');
            return ;
        }

        $redis_start = 'command:bonus-settlement-start';
        $bonus_settlement_id =  Redis::get($redis_start);
        if($bonus_settlement_id){
            Redis::del($redis_start);
            $bonus_settlement = BonusSettlement::where($bonus_settlement_id)->first();
            if($bonus_settlement){
                try{
                    $start_time = $bonus_settlement->start_time;
                    $end_time = $bonus_settlement->end_time;
                    $bonus_settlement_id = $bonus_settlement->id;
                }catch (\Exception $e){
                    \Log::channel('push_pv')->info('结算异常',[$e->getMessage()]);
                }
                $levels = Level::getLevels();
                //获取可结算业绩
                PvOrder::whereBetween('create_time',[$start_time,$end_time])->where('status',1)
                    ->orderBy('id', 'asc')
                    ->chunk(1000, function ($members)use($levels) {
                        //模拟进单顺序结算

                    });
            }

        }
        sleep(1);








    }

    //结算
    public function settlement($bonus_settlement)
    {
        try{
            $start_time = $bonus_settlement->start_time;
            $end_time = $bonus_settlement->end_time;
            $bonus_settlement_id = $bonus_settlement->id;
        }catch (\Exception $e){
            \Log::channel('push_pv')->info('结算异常',[$e->getMessage()]);
        }

        $levels = Level::getLevels();

        //计算业绩发放极差奖励
        Member::where('pv','>',0)->where('is_disabled','<',9)->orderByDesc('id')->chunk(1000, function ($members)use($start_time,$end_time,$bonus_settlement_id,$levels) {
            /**** @var Member $member ****/
            foreach ($members as $member){
                //计算是否有新增业绩
                $performance = PvOrder::whereBetween('create_time',[$start_time,$end_time])->sum('amount');
                $is_performance = NewPerformance::whereMemberId($member->id)->where('bonus_id',$bonus_settlement_id)->first();
                if($performance > 0 && empty($is_performance)){
                    //新增业绩
                    $new_performance =  new NewPerformance();
                    $new_performance->member_id = $member->id;
                    $new_performance->status = 0;
                    $new_performance->type = 1;
                    $new_performance->performance = $performance;
                    $new_performance->save();
                    //发放极差奖励
                    $all_grant =$this->grantJicha($member->pid,$new_performance,0,$levels);
                    $new_performance->grant = $all_grant;
                    $new_performance->status = 1;
                    $new_performance->save();
                }

            }

        });

        //开始统计市场业绩
        Member::where('is_disabled','<',9)->where('shop_level','>',0)->orderByDesc('id')->chunk(1000, function ($members)use($start_time,$end_time,$bonus_settlement_id,$levels) {
            /**** @var Member $member ****/
            foreach ($members as $member){
                //计算是否有新增业绩
                $performance = PvOrder::whereBetween('create_time',[$start_time,$end_time])->sum('amount');
                $is_performance = NewPerformance::whereMemberId($member->id)->where('bonus_id',$bonus_settlement_id)->first();
                if($performance > 0 && empty($is_performance)){
                    //新增业绩
                    $new_performance =  new NewPerformance();
                    $new_performance->member_id = $member->id;
                    $new_performance->status = 0;
                    $new_performance->type = 1;
                    $new_performance->performance = $performance;
                    $new_performance->save();
                    //发放极差奖励
                    $all_grant =$this->grantJicha($member->pid,$new_performance,0,$levels);
                    $new_performance->grant = $all_grant;
                    $new_performance->status = 1;
                    $new_performance->save();
                }

            }

        });




    }


    public function grantJicha($one_spread_uid,$new_performance,$level,$levels,$all_grant = 0,$i=0)
    {
        $i ++; //防止死循环
        /**** @var NewPerformance $new_performance ****/
        $member = Member::whereId($one_spread_uid)->first();
        if(empty($member) || $i > 100){
            return $all_grant;
        }
        if($member->is_disabled == 9){
            //删除用户直接跳过
            $this->grantJicha($member->pid,$new_performance,$level,$levels,$all_grant,$i);
        }
        if($member->level > $level){
            //发放奖励
            $ratio = $levels[$member->level]['jc_ratio'];
            if($level){
                $a_jc_ratio = $levels[$level]['jc_ratio'];
                $ratio = $ratio - $a_jc_ratio;
            }

            $grant = bcmul($new_performance->performance,$ratio,2);
            if($grant > 0){
                $remark = "福利奖励等级:{$member->level}-{$level}";
                IntegralLogs::changeIntegral($grant,$member,1,8,$new_performance->id,$remark);
            }


            $all_grant = $all_grant + $grant;
            $level = $member->level;
        }
        if(empty($member->pid)){
            return $all_grant;
        }

        $this->grantJicha($member->pid,$new_performance,$level,$levels,$all_grant,$i);
    }


    public function insertBonusSettlement($bonus_settlement,$status)
    {

    }
}

