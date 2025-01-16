<?php

namespace App\Jobs;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Member;
use App\Model\DikouquanLog;
use App\Model\LevelLog;
use App\Model\ShopNumber;
use App\PostSaveMember;
use App\PvLogs;
use App\ShopLevel;
use App\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ChangeOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * 任务可以执行的最大秒数 (超时时间)。
     *
     * @var int
     */
    public $timeout = 600;

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
        if(isset($order_id['id'])){
            //导入修改
            $success_status = 7; //成功状态
            $order_id = $order_id['id'];
            $change_order = PostSaveMember::whereId($order_id)->first();
            if($change_order->status != 4){
                \Log::channel('user')->info('导入状态不对change_order_id:'.$order_id);
                return;
            }
            $change_order->status = 6;
            $content = json_decode($change_order->content,true);
            $user = Member::whereId($change_order->member_id)->first();

        }else{
            $success_status = 3;  //成功状态
            $change_order = ChangeOrder::whereId($order_id)->first();
            if($change_order->status != 2){
                \Log::channel('user')->info('状态不对change_order_id:'.$order_id);
                return;
            }
            $change_order->status = 4;
            $content = json_decode($change_order->content,true);
            $user = Member::whereId($change_order->member_id)->first();
        }


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
                $change_order->status = $success_status;
                break;
            case 2:
                if(isset($content['level_after'])){
                    LevelLog::addLevelLog($user,$content['level_after'],2,1);
                    $user->level = $content['level_after'];
                    $user->save();
                    $change_order->status = $success_status;
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
                    $change_order->status = $success_status;
                }
                break;
            case 4:
                //营业额变动
                $result = '';
                if($content['amount'] > 0){
                    $remark = '';
                    if(!empty($content['remark'])){
                        $remark = $content['remark'];
                    }
                    $result = PvLogs::addPv($user->id,abs($content['amount']),2,$remark);
                }
                if($result){
                    $change_order->status = $success_status;
                }

                break;
            case 5:
                $user->is_disabled = $content['status_after'];
                $user->save();
                $change_order->status = $success_status;
                break;
            case 6:
                try {
                if(isset($content['pid_before']) && isset($content['pid_after'])){
                    $p = Member::whereId($content['pid_after'])->first();
                    if(!$p) {
                        throw new \App\Exceptions\BizException('找不到父节点');
                    }
                    $cid = $user->id;
                    \DB::transaction(function() use($cid,  $p){
                        $m = Member::whereId($cid)->first();
                        if(!$m) {
                            throw new \App\Exceptions\BizException('找不到子节点');
                        }
                        $paths = explode('/', $p->path);
                        if(in_array($m->id, $paths)) {
                            throw new Exception('闭环');
                        }
                        $m->deep = $p->deep + 1;
                        $m->pid = $p->id;
                        if($p->path){
                            $path = $p->path . $p->id.'/';
                        }else{
                            $path = '/'.$p->id.'/';
                        }
                        $m->path = $path;
                        $m->save();
                        $this->migrateMemberPath($m);
                        \Log::channel('user')->info('网体移动', [$m->id,$p->id]);
                    });
                    $user->pid = $content['pid_after'];
                    $user->save();
                    $change_order->status = $success_status;
                }
                } catch (\Exception $e) {
                    \Log::channel('user')->info('网体移动失败', [$e->getMessage()]);
                }
                break;
            case 7:
                if(isset($content['level_after'])){
                    //验证组号
                    if(!empty($content['zuohao'])){
                        $shop_number = ShopNumber::whereNumber($content['zuohao'])->first();
                        if(empty($shop_number->id)){
                            break;
                        }
                        if($shop_number->member_id){
                            break;
                        }
                        $shop_number->member_id = $user->id;
                        $shop_number->status = 1;
                        $shop_number->save();
                    }
                    $old_shop_level = $user->shop_level;
                    LevelLog::addLevelLog($user,$content['level_after'],2,2);
                    $user->shop_level = $content['level_after'];
                    $change_order->status = $success_status;
                    if($old_shop_level == 0){
                        ShopLevel::setShopLowerMember($user);
                    }
                }
                break;
            case 8:
                $user->lock_shop_level = $content['status_after'];
                $user->save();
                $change_order->status = $success_status;
                break;

            case 9:
                //抵扣劵变动
                if($content['amount'] > 0){
                    $result = DikouquanLog::changeIntegral(abs($content['amount']),$user,1,1,$change_order->id);
                }else{
                    $result = DikouquanLog::changeIntegral(abs($content['amount']),$user,0,12,$change_order->id);
                }
                if($result){
                    $change_order->status = $success_status;
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
                    $change_order->status = $success_status;
                }
                break;
            case 11:
                //特殊已结算业绩
                $user->divvy_pv_t = $user->divvy_pv_t + $content['amount'];
                $result = $user->save();
                if($result){
                    Member::checkAdminLevel($user);
                    $change_order->status = $success_status;
                }
                break;
            case 12:
                //转账消费券
                if($content['amount'] > 0){
                    try{
                        \DB::transaction(function() use ($content, $user){
                            $to_user = Member::where('number',$content['to_number'])->first();
                            $amount = $content['amount'];
                            if($amount <= 0){
                                throw new BizException('数量有误');
                            }
                            $member = Member::whereId($user->id)->first();
                            if($member->dikouquan_k < $amount){
                                throw new BizException('数量不足');
                            }
                            //生成转账记录
                            $ransfer = new Transfer();
                            $ransfer->member_id = $member->id;
                            $ransfer->c_member_id = $to_user->id;
                            $ransfer->amount = $amount;
                            $ransfer->fee = 0;
                            $ransfer->actual_amount = $amount;
                            $ransfer->save();
                            $related_id = $ransfer->id;
                            //数量变动
                            $remark = '转出到'.$to_user->mobile;
                            DikouquanLog::changeIntegralK($amount,$member,0,16,$related_id,$remark);
                            $remark = $member->mobile.'转入';
                            DikouquanLog::changeIntegralK($amount,$to_user,1,6,$related_id,$remark);
                        });
                        $change_order->status = $success_status;

                    } catch (\Exception $e) {
                        $change_order->status = 0;
                        $content['error_msg'] = $e->getMessage();
                        $change_order->content = json_encode($content);
                    }


                }
                break;

        }

        $change_order->save();




    }

    public function migrateMemberPath($member)
    {
        $children = $member->children;
        foreach($children as $child) {
            $child->deep = $member->deep + 1;
            $child->path = $member->path . $member->getKey().'/';
            $child->save();
            $this->migrateMemberPath($child);
        }
    }
}
