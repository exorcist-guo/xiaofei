<?php

namespace App\Jobs;

use App\DivvyPvLogs;
use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Level;
use App\LoginLog;
use App\Member;
use App\Model\LevelLog;
use App\PvLogs;
use App\PvOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PushPvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $push_order_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->push_order_id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id = $this->push_order_id;
        $push_order = PvOrder::whereId($id)->first();
        try{

            if($push_order->status == 0){
                \DB::transaction(function() use($push_order){
                    $user = Member::whereId($push_order->member_id)->first();
                    if(empty($user)){
                        //未找到用户
                        $push_order->status = 7;
                        $push_order->save();
                        return true;
                    }
                    if(in_array($user->is_disabled,[5,9])){
                        //状态为锁定、注销的会员从商城推送过来的订单不接收
                        $push_order->status = $user->is_disabled;
                        $push_order->save();
                        return true;
                    }
                    $push_order->status = 1;
                    $push_order->save();
                    //增加业绩
                    $time = date("Y-m-d H:i:s");
                    $amount = $push_order->amount;
                    $balance_before = $user->pv;
                    $balance_after = bcadd($balance_before,$amount,2);
                    $log_data = [
                        'member_id' => $user->id,
                        'action' => 1,
                        'amount' => $amount,
                        'balance_before' => $balance_before,
                        'balance_after' => $balance_after,
                        'remark' => '',
                        'related_id' => $push_order->id,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                    $in_log = PvLogs::setSuffix($user->id,1)->insertGetId($log_data);
                    $user->pv = $balance_after;
//                    $user->divvy_pv = bcadd($user->divvy_pv,$amount,2);
                    $success = $in_log && $user->save();
                    if(!$success) {
                        throw new BizException('业绩增加失败');
                    }
                    /*
                    $levels = Level::getLevels();

                    //判断是否升级
                    $c_level = $user->level + 1;
                    if(isset($levels[$c_level]) && $user->pv >= $levels[$c_level]['pv']){
                        LevelLog::addLevelLog($user,$c_level,1,1);
                        $user->level = $c_level;
                        $user->save();
                    }

                    //累计两千奖励发放
                    $leiji_limit = 2000;
                    if($user->divvy_pv >= $leiji_limit){
                        //发放自己300
                        $award_amount = 300;
                        $s_user = Member::whereId($user->pid)->first();
                        if($s_user){
                            $s_member_id = $s_user->id;
                            $s_count = Member::wherePid($s_member_id)
                                ->where('is_disabled',0)
                                ->where('level','>',0)
                                ->count();
                            if($s_count > 3){
                                $s_count = 3;
                            }
                            $s_award_amount = 100 * $s_count;
                        }else{
                            $s_member_id = 0;
                            $s_award_amount = 0;
                        }
                        $divvy_pv_logs = new DivvyPvLogs();
                        $divvy_pv_logs->member_id = $user->id;
                        $divvy_pv_logs->amount = $leiji_limit;
                        $divvy_pv_logs->award_amount = $award_amount;
                        $divvy_pv_logs->s_member_id = $s_member_id;
                        $divvy_pv_logs->s_award_amount = $s_award_amount;
                        $divvy_pv_logs->save();
                        IntegralLogs::changeIntegral($award_amount,$user,1,5,$divvy_pv_logs->id);
                        if($s_member_id){
                            IntegralLogs::changeIntegral($s_award_amount,$s_user,1,6,$divvy_pv_logs->id);
                        }
                        $user->divvy_pv = bcsub($user->divvy_pv,$leiji_limit,2);
                        $user->save();
                    }
                    //发放推广奖励
                    if($user->pid){
                        $p_user = Member::whereId($user->pid)
                            ->first();
                        if($p_user->level > 0){
                            $level = Level::whereId($p_user->level)->first();
                            if($level && $level->tj_ratio){

                                $t_amount = bcmul($amount,$level->tj_ratio,2);
                                IntegralLogs::changeIntegral($t_amount,$p_user,1,4,$in_log->id,'推荐用户新增业绩:'.$amount);
                            }
                        }

                    }
                    */
                });

            }
        }catch (\Exception $e){
            \Log::channel('push_pv')->info('push_order_id:'.$id,[$e->getMessage()]);
        }
    }
}
