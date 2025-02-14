<?php

namespace App\Console\Commands;

use App\DivvyPvLogs;
use App\IntegralLogs;
use App\Level;
use App\Member;
use App\Model\BonusSettlement;
use App\Model\DikouquanLog;
use App\Model\LevelLog;
use App\Model\NewPerformance;
use App\Model\SettlementLog;
use App\Model\SettlementMember;
use App\PvOrder;
use App\ShopLevel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
//        Redis::set($reids_lock,1,'ex',60);
//
        while (true){
            $redis_start = 'command:bonus-settlement-start';
            $bonus_settlement_id =  Redis::get($redis_start);
//        $bonus_settlement_id = 2;
            if($bonus_settlement_id){
                Redis::del($redis_start);

                $is_open_chuxiao = config('dividend.is_open_chuxiao',0);

                $bonus_settlement = BonusSettlement::whereId($bonus_settlement_id)->first();
                if($bonus_settlement){
                    try{
                        $start_time = $bonus_settlement->start_time;
                        $end_time = $bonus_settlement->end_time;
                        $bonus_settlement_id = $bonus_settlement->id;
                    }catch (\Exception $e){
                        \Log::channel('bonus_settlement')->info('结算异常',[$e->getMessage()]);
                    }
                    $levels = Level::getLevels();
                    //获取可结算业绩

                    //团队奖励结算
                    $shop_levels = ShopLevel::getLevels();

                    //whereBetween('created_at',[$start_time,$end_time])-> 时间限制，正式需要调用
                    PvOrder::where('status',1)
                        ->orderBy('id', 'asc')
                        ->chunk(1000, function ($pv_orders)use($levels,$shop_levels,$bonus_settlement_id,$is_open_chuxiao) {
                            //模拟进单顺序结算
                            foreach ($pv_orders as $pv_order){
                                try{
                                    $pv_order->status = 2;
                                    $pv_order->save();

                                    $user = Member::whereId($pv_order->member_id)->first();
                                    if(!$user || $user->is_disabled == 9){
                                        continue;
                                    }
                                    if($user->is_chuxiao){
                                        //限时促销
                                        if($is_open_chuxiao == 1){
                                            $this->chuxiao($user,$pv_order,$bonus_settlement_id);
                                        }
                                    }






                                    //增加结算业绩
                                    $user = $this->addDivvyPv($user,$pv_order,$bonus_settlement_id,$levels);

                                    //激活奖励
//                                    $this->jihuoJiang($user,$pv_order,$bonus_settlement_id);

                                    if($user->is_chuxiao){
                                        //极差奖励
                                        $this->jicha($user,$pv_order,$bonus_settlement_id,$levels);

                                        //推荐奖励
                                        $this->tuijian($user,$pv_order,$bonus_settlement_id,$levels);

                                        //服务奖励，服务补贴
                                        $this->fuwu($user,$pv_order,$bonus_settlement_id,$shop_levels);
                                    }





                                }catch (\Exception $e){
                                    \Log::channel('bonus_settlement')->info('结算中异常',[$e->getMessage(),$e->getLine(),$e->getFile()]);
                                }

                            }

                        });

                    SettlementMember::where('bonus_settlement_id',$bonus_settlement_id)->where('status',0)->update(['status'=>1]);

//                    Member::where('shop_level','>',0)->chunk(500, function ($members)use($shop_levels,$bonus_settlement_id) {
//                        //模拟进单顺序结算
//                        foreach ($members as $user){
//                            try{
//                                //服务奖励，服务补贴
//                                $this->tuandui($user,$bonus_settlement_id,$shop_levels);
//
//                            }catch (\Exception $e){
//                                \Log::channel('bonus_settlement')->info('团队结算中异常',[$e->getMessage()]);
//                            }
//                        }
//
//                    });





                }

                $new_bonus_settlement = new BonusSettlement();
                $new_bonus_settlement->status = 20;
                $new_bonus_settlement->admin_id = $bonus_settlement->admin_id;
                $new_bonus_settlement->start_time = $bonus_settlement->start_time;
                $new_bonus_settlement->end_time = $bonus_settlement->end_time;

                $new_bonus_settlement->save();

            }
            sleep(2);
            //发放奖励
            $redis_send = 'command:bonus-settlement-send';
            $bonus_settlement_id = Redis::get($redis_send);
            if($bonus_settlement_id){
                Redis::del($redis_send);

                SettlementMember::where('bonus_settlement_id',$bonus_settlement_id)->where('status',1)->chunk(500, function ($SettlementMember) {
                    //模拟进单顺序结算
                    foreach ($SettlementMember as $settlement_member){
                        try{

                            //发放奖励
                            $this->fafang($settlement_member);

                        }catch (\Exception $e){
                            \Log::channel('bonus_settlement')->info('发放奖励',[$e->getMessage(),$e->getLine(),$e->getFile()]);
                        }
                    }

                });

            }
            sleep(2);
        }



    }


    public function fuwu($user,$pv_order,$bonus_settlement_id,$shop_levels){
        $user_ids = array_reverse(explode('/',$user->path));
        $user_ids[0] = $user->id;
        $user_ids = array_filter($user_ids);
        $shop_level = 0;
        $member_id_j = 0;
        $member_id_list = Member::getIdMember($user_ids);
        $all_pv = $pv_order->amount;
        if(empty($all_pv)){
            return true;
        }
        $o_created_at = $pv_order->created_at->format('Y-m-d H:i:s');
        foreach ($user_ids as $usre_id){
            if(!empty($member_id_list[$usre_id])){
                /** @var Member $member */
                $member = $member_id_list[$usre_id];
                if(!$member || $member->is_chuxiao == 0 || $member->is_disabled == 9){
                    continue;
                }
                if($member->shop_level > $shop_level){

                    if($member->shop_level_time > $o_created_at){

                        //成为社区时间小于业绩时间
                        $level_logs = LevelLog::whereMemberId($member->id)
                            ->where('type',2)
                            ->orderByDesc('id')->get();
                        $is_stop = true;
                        //寻找合适的时间
                        foreach ($level_logs as $level_log){
                            if($level_log->level_after > $shop_level && $level_log->created_at->format('Y-m-d H:i:s') < $o_created_at){
                                $is_stop = false;
                                $member->shop_level = $level_log->level_after;
                                break;

                            }
                        }
                        if($is_stop){
                            continue;
                        }
                    }
                    $settlement_member = SettlementMember::getSettlementMember($member,$bonus_settlement_id);
                    $ratio = $shop_levels[$member->shop_level]['jc_ratio'];
                    if($shop_level){
                        $ratio_j = $shop_levels[$shop_level]['jc_ratio'];
                        $remark = "账号:{$member->number}比率:{$ratio}极差账号:{$member_id_j}比率:{$ratio_j}";
                        $type = 8; //服务补贴
                    } else{
                        $ratio_j = 0;
                        $remark = '';
                        $type = 7;  //服务费
                    }
                    $y_ratio = bcsub($ratio,$ratio_j,2);
                    $s_amount = bcmul($y_ratio, $all_pv,2);
                    SettlementLog::addLog($s_amount,$all_pv,$y_ratio,$settlement_member,$type,$pv_order->id,$remark);
                    $shop_level = $member->shop_level;
                    $member_id_j = $member->number;
                }


            }
        }
    }

    //$this->fafang();
    public function fafang($settlement_member){
        /** @var SettlementMember $settlement_member */
        if($settlement_member->status == 1){
            $member = Member::whereId($settlement_member->member_id)->first();
            $settlement_member->status = 2;
            $settlement_member->save();

            if($settlement_member->jh  > 0){
                if($member->dikouquan){
                    $amount = $settlement_member->jh;
                    if($amount > $member->dikouquan){
                        $amount = $member->dikouquan;
                    }
                    DikouquanLog::changeIntegral($amount,$member,2,15,$settlement_member->id,'结算奖励');
                    DikouquanLog::changeIntegralK($amount,$member,1,5,$settlement_member->id,'结算奖励');
                }
            }

            if($settlement_member->jc > 0){
                IntegralLogs::changeIntegral($settlement_member->jc,$member,1,4,$settlement_member->id);
            }

            if($settlement_member->fl > 0){
                IntegralLogs::changeIntegral($settlement_member->fl,$member,1,10,$settlement_member->id);
            }

            if($settlement_member->tj  > 0){
                IntegralLogs::changeIntegral($settlement_member->tj,$member,1,5,$settlement_member->id);
            }

            if($settlement_member->fw  > 0){
                IntegralLogs::changeIntegral($settlement_member->fw,$member,1,6,$settlement_member->id);
            }

            if($settlement_member->bt > 0){
                IntegralLogs::changeIntegral($settlement_member->bt,$member,1,7,$settlement_member->id);
            }

            if($settlement_member->cx  > 0){
                IntegralLogs::changeIntegral($settlement_member->cx,$member,1,8,$settlement_member->id);
            }



        }



    }

    //服务奖励，服务补贴
    public function tuandui($user,$bonus_settlement_id,$shop_levels){


    }

    //限时促销
    public function chuxiao($user,$pv_order,$bonus_settlement_id){
        $user = Member::whereId($user->id)->first();
        if($user->is_chuxiao){
            $y_ratio = 0.03;
            $settlement_member = SettlementMember::getSettlementMember($user,$bonus_settlement_id);
            $s_amount = bcmul($y_ratio, $pv_order->cash_amount,2);
            SettlementLog::addLog($s_amount,$pv_order->cash_amount,$y_ratio,$settlement_member,6,$pv_order->id);

            if($user->pid){
                $member = Member::whereId($user->pid)->first();
                if(!$member || !$member->is_chuxiao || $member->is_disabled == 9){
                    //未激活，不给奖励
                    return true;
                }
                $count = Member::wherePid($user->pid)->where('divvy_pv','>=',400)->count();
                if($count){
                    $settlement_member = SettlementMember::getSettlementMember($member,$bonus_settlement_id);
                    $y_ratio = bcmul(0.01 , $count,2);
                    if($y_ratio > 0.03){
                        $y_ratio = 0.03;
                    }

                    $s_amount = bcmul($y_ratio, $pv_order->cash_amount,2);

                    SettlementLog::addLog($s_amount,$pv_order->cash_amount,$y_ratio,$settlement_member,9,$pv_order->id,"邀请合格人数{$count}");
                }
            }



        }


    }

    //增加结算业绩
    public function addDivvyPv($user,$pv_order,$bonus_settlement_id,$levels=[]){
        $amount = $pv_order->amount;
        DivvyPvLogs::changeIntegral($amount,$user,1,1,$pv_order->id);
        $settlement_member = SettlementMember::getSettlementMember($user,$bonus_settlement_id);
        SettlementLog::addLog($amount,$pv_order->amount,1,$settlement_member,5,$pv_order->id);

        Member::checkLevel($user,$levels);
        if($user->is_chuxiao == 0){
            $sum_xj = PvOrder::whereMemberId($user->id)->where('status',2)->sum('cash_amount');
            if($sum_xj >= 400){
                $user->is_chuxiao = 1;
                $user->chuxiao_time = $pv_order->created_at;
                $user->save();
            }
        }
        return $user;
    }

    //极差奖励
    public function jicha($user,PvOrder $pv_order,$bonus_settlement_id,$levels){
        $user_ids = array_reverse(explode('/',$user->path));
        $user_ids[0] = $user->id;
        $level = 0;
        $member_id_j = 0;

        foreach ($user_ids as $user_id){
            if(!$user_id) continue;
            $member = Member::whereId($user_id)->first();
            if($member && $member->is_chuxiao && $member->level > $level && $member->is_disabled < 9){
                $settlement_member = SettlementMember::getSettlementMember($member,$bonus_settlement_id);
                $ratio = $levels[$member->level]['jc_ratio'];
                if($level){
                    $ratio_j = $levels[$level]['jc_ratio'];
                } else{
                    $ratio_j = 0;
                }
                $y_ratio = bcsub($ratio,$ratio_j,2);
                $s_amount = bcmul($y_ratio, $pv_order->amount,2);

                if($user->id == $member->id){
                    $type = 10;
                    $remark = "自购比率:{$ratio}";
                }else{
                    $type = 3;
                    $remark = "账号:{$member->number}比率:{$ratio}极差:{$member_id_j}比率:{$ratio_j}";
                }


                SettlementLog::addLog($s_amount,$pv_order->amount,$y_ratio,$settlement_member,$type,$pv_order->id,$remark);
                $level = $member->level;
                $member_id_j = $member->number;

            }
        }
    }

    public function tuijian(Member $user,PvOrder $pv_order,$bonus_settlement_id,$levels){
        if($user->pid){
            $member = Member::whereId($user->pid)->first();
            if($member && $member->is_chuxiao &&  !empty( $levels[$member->level]['jc_ratio']) && $member->is_disabled < 9){
                $settlement_member = SettlementMember::getSettlementMember($member,$bonus_settlement_id);
                $y_ratio =  $levels[$member->level]['tj_ratio'];
                $s_amount = bcmul($y_ratio, $pv_order->amount,2);
                SettlementLog::addLog($s_amount,$pv_order->amount,$y_ratio,$settlement_member,4,$pv_order->id);
            }
        }
    }


    //激活奖励
    public function jihuoJiang(Member $user,PvOrder $pv_order,$bonus_settlement_id)
    {

        //推荐三个人消费400给奖励400
        if($user->pid){
            $member = Member::whereId($user->pid)->first();
            if($member->is_active < 3){
                $count = Member::wherePid($member->id)->where('divvy_pv','>=',400)->count();
                if($count >= 3){
                    if($user && $user->dikouquan > 0){
                        //有冻结消费券的用户
                        $jihuo_amount = 400;
                        $settlement_member = SettlementMember::getSettlementMember($user,$bonus_settlement_id);
                        SettlementLog::addLog($jihuo_amount,$jihuo_amount,1,$settlement_member,1,$pv_order->id);
                        $member->is_active = 3;
                        $member->save();
                    }
                }
            }

        }

        //老会员本人及网体下人员，每期消费都可以激活现金消费部分的25%的消费券到可用余额
        $user_ids = explode('/',$user->path);
        $user_ids[0] = $user->id;
        $jihuo_ratio = 0.25; //激活比率
        $jihuo_amount = bcmul($pv_order->amount,$jihuo_ratio,2);
        foreach ($user_ids as $user_id){
            if(!$user_id) continue;
            $member = Member::whereId($user_id)->first();
            if($member && $member->dikouquan > 0){
                //有冻结消费券的用户
                $settlement_member = SettlementMember::getSettlementMember($member,$bonus_settlement_id);
                SettlementLog::addLog($jihuo_amount,$pv_order->amount,$jihuo_ratio,$settlement_member,2,$pv_order->id);
            }
        }

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

