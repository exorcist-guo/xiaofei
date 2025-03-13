<?php

namespace App\Http\Controllers;

use App\Exceptions\BizException;
use App\Jobs\PushPvJob;
use App\Member;
use App\PushOrder;
use App\PvLogs;
use App\PvOrder;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ForeignController extends Controller
{
    use ApiResponseTrait;

    public function updateStatus(Request $request){
        $order_no = $request->input('order_no','');
        $order_nos = explode(',',$order_no);
        $status = PushOrder::whereIn('order_no',$order_nos)
            ->where('status',0)
            ->update(['status'=>1]);

        return $this->success('处理成功',$status);
    }

    public function checkMobile(Request $request)
    {
        try {
            $mobile = $request->input('mobile','');
//            $real_name = $request->input('real_name','');
//            $id_number = $request->input('id_number','');
            if(empty($mobile)){
                throw new BizException('参数有误');
            }



            $user = Member::whereMobile($mobile)->first();
            if(empty($user)){
                throw new BizException('用户不存在');
            }
//            if($real_name != $user->real_name){
//                throw new BizException('姓名不匹配');
//            }
//            if($id_number != $user->id_number){
//                throw new BizException('证件号不匹配');
//            }


            if($user->is_active == 0){
                $user->is_active = 1;
                $user->save();
            }
            $data = [
                'mobile' => $mobile,
//                'real_name' => $real_name,
//                'id_number' => $id_number
            ];
            return $this->success('用户匹配成功',$data);
        }catch (\Throwable $e){
            return $this->error($e->getMessage());
        }

    }

    public function getOrder(Request $request){
        $list = PushOrder::whereStatus(0)->limit(100)->get();
        $data = [];
        foreach ($list as $order){
            $order->content = json_decode($order->content);
            $data[] = $order;
        }
        return $this->success('获取成功',$data);
    }

    public function pushPv(Request $request){
        $order_no = $request->input('order_no','');
        $mobile = $request->input('mobile','');
        $amount = $request->input('amount',0);
        $cash_amount_new = $request->input('cash_amount',0);
        $redis_key = 'push_mobile'.$order_no;
        $point = $request->input('point',0);
        $dikou = $request->input('dikou',0);

        try {
            if(!Redis::set($redis_key, 1, 'ex', 15, 'nx')) {
                throw new BizException($mobile.'业务正在处理请不要重复提交');
            }
            if(!($amount > 0)){
                throw new BizException('数量有误');
            }
            if(empty($order_no) || empty($mobile)){
                throw new BizException('订单号或证件号不能为空');
            }
            $user = Member::whereMobile($mobile)->first();

            if(empty($user)){
                $user_id = 0;
//                return $this->error('用户不存在');
            }else{
                $user_id = $user->id;
            }
            $order =  PvOrder::whereOrderNo($order_no)->first();
            if($order){
                throw new BizException('订单号重复');
            }
            if(config('dividend.jieduan_chuxiao',2) == 1){
                $cash_amount =  $amount;
            }else{
                $cash_amount =  $cash_amount_new;
            }
//            \DB::transaction(function() use($user, $request){
//                $user = Member::whereId($user->id)->lockForUpdate()->first();
//                $order_no = $request->input('order_no','');
//                $id_number = $request->input('id_number','');
//
//                $amount = $request->input('amount',0);
                //插入订单
                $time = date("Y-m-d H:i:s");
                $order_id = PvOrder::insertGetId([
                    'member_id' => $user_id,
                    'mobile' => $mobile,
                    'order_no' => $order_no,
                    'amount' => $amount,
                    'cash_amount' => $cash_amount,
                    'cash_amount_new' => $cash_amount_new,
                    'status' => 0,
                    'created_at' => $time,
                    'updated_at' => $time,
                    'point' => $point,
                    'dikou' => $dikou,

                ]);
                if(!$order_id){
                    throw new BizException('插入订单失败');
                }
            PushPvJob::dispatch($order_id)
                ->onQueue('push_pv_job')
            ;
//                $balance_before = $user->pv;
//                $balance_after = bcadd($balance_before,$amount,2);
//                $log_data = [
//                    'member_id' => $user->id,
//                    'action' => 1,
//                    'amount' => $amount,
//                    'balance_before' => $balance_before,
//                    'balance_after' => $balance_after,
//                    'remark' => '',
//                    'related_id' => $order_id,
//                    'created_at' => $time,
//                    'updated_at' => $time,
//                ];
//                $in_log = PvLogs::setSuffix($user->id,1)->insertGetId($log_data);
//                $user->pv = $balance_after;
//                $user->divvy_pv = bcadd($user->divvy_pv,$amount,2);
//                $success = $in_log && $user->save();
//                if(!$success) {
//                    throw new BizException('操作失败');
//                }
//            });
            return $this->success('操作成功');
            Redis::del($redis_key);
        } catch (\Throwable $e) {
            Redis::del($redis_key);
            return $this->error($e->getMessage());
        }






    }


    public function test(Request $request){
        var_dump(77);
    }
}
