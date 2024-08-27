<?php

namespace App\Jobs;

use App\ChangeOrder;
use App\IntegralLogs;
use App\Member;
use App\Model\DikouquanLog;
use App\Model\LevelLog;
use App\ShopLevel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $order_id;
    public function __construct($id)
    {
        $this->order_id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order_id = $this->order_id;
        $change_order = ChangeOrder::whereId($order_id)->first();
        if($change_order->status != 2){
            \Log::channel('user')->info('状态不对change_order_id:'.$order_id);
        }
        $change_order->status = 4;
        $content = json_decode($change_order->content,true);
        $user = Member::whereId($change_order->member_id)->first();
        switch ($change_order->type){
            case 1:
                if(!empty($content['nation'])){
                    $user->nation = $content['nation'];
                }
                if(!empty($content['certificate_type'])){
                    $user->certificate_type = $content['certificate_type'];
                }
                if(!empty($content['mobile'])){
                    $user->mobile = $content['mobile'];
                }
                if(!empty($content['real_name'])){
                    $user->real_name = $content['real_name'];
                }
                if(!empty($content['id_number'])){
                    $user->id_number = $content['id_number'];
                }
                if(!empty($content['password'])){
                    $user->password = \Hash::make($content['password']);
                }
                if(!empty($content['transaction_password'])){
                    $user->transaction_password = \Hash::make($content['transaction_password']);
                }
                $user->save();
                $change_order->status = 3;
                break;
            case 2:
                if(isset($content['level_after'])){
                    LevelLog::addLevelLog($user,$content['level_after'],2,1);
                    $user->level = $content['level_after'];
                    $user->save();
                    $change_order->status = 3;
                }
                break;
            case 3:
                //积分变动
                if($content['amount'] > 0){
                    $result = IntegralLogs::changeIntegral(abs($content['amount']),$user,1,7,$change_order->id);
                }else{
                    $result = IntegralLogs::changeIntegral(abs($content['amount']),$user,0,14,$change_order->id);
                }
                if($result){
                    $change_order->status = 3;
                }
                break;
            case 4:

                break;
            case 5:
                $user->is_disabled = $content['status_after'];
                $user->save();
                $change_order->status = 3;
                break;
            case 6:
                if(isset($content['pid_before']) && isset($content['pid_after'])){
                    $user->pid = $content['pid_after'];
                    $user->save();
                    $change_order->status = 3;
                }
                break;
            case 7:
                if(isset($content['level_after'])){
                    LevelLog::addLevelLog($user,$content['level_after'],2,2);
                    $old_shop_level = $user->shop_level;
                    $user->shop_level = $content['level_after'];
                    $user->save();
                    $change_order->status = 3;
                    if($old_shop_level == 0){
                        ShopLevel::setShopLowerMember($user);
                    }
                }
                break;
            case 8:
                $user->lock_shop_level = $content['status_after'];
                $user->save();
                $change_order->status = 3;
                break;

            case 9:
                //抵扣劵变动
                if($content['amount'] > 0){
                    $result = DikouquanLog::changeIntegral(abs($content['amount']),$user,1,1,$change_order->id);
                }else{
                    $result = DikouquanLog::changeIntegral(abs($content['amount']),$user,0,12,$change_order->id);
                }
                if($result){
                    $change_order->status = 3;
                }
                break;
            case 10:
                //抵扣劵变动
                if($content['amount'] > 0){
                    $result = DikouquanLog::changeIntegralK(abs($content['amount']),$user,1,2,$change_order->id);
                }else{
                    $result = DikouquanLog::changeIntegralK(abs($content['amount']),$user,0,13,$change_order->id);
                }
                if($result){
                    $change_order->status = 3;
                }
                break;

        }

        $change_order->save();




    }
}
