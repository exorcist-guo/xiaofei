<?php

namespace App\Http\Controllers;

use App\Category;
use App\ContractComposeRecord;
use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Jobs\PushPvJob;
use App\Member;
use App\Model\DikouquanLog;
use App\PushDikouquan;
use App\PushIntegral;
use App\PushOrder;
use App\PvLogs;
use App\Traits\ApiResponseTrait;
use App\Transfer;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IntegralController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request){
        /** @var Member $user */
        $user = $request->user();

        $data = [
            'day_integral' => 0,
            'integral' => $user->integral,
            'pv' => $user->pv,
            'month_pv' => $user->pv,
        ];

        return $this->success('成功',$data);
    }

    public function log(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $page = $request->input('page', 1);
        $limit = 16;
        $status_map =  IntegralLogs::STATUS_MAP;
        $data = IntegralLogs::whereMemberId($user->id)
            ->orderBy('id', 'desc')
            ->forPage($page, $limit)
            ->get()
            ->map(function(IntegralLogs $log)use($status_map){
                $data =  $log->only(['id', 'member_id', 'action', 'amount', 'balance_before','balance_after','remark', 'created_at']);
                $data['action_name'] = isset($status_map[$data['action']])?$status_map[$data['action']]:$data['action'];
                $data['created_at'] = date('Y-m-d H:i', $log->created_at->timestamp);
                return $data;
            })
        ;

        return $this->success('success', $data);

    }

    public function pvInfo(Request $request)
    {
        /** @var Member $user */
        $user = $request->user();
        $data = [
            'pv' => $user->pv,
            'month_pv' => $user->pv,
            'last_month_pv' => 0,

        ];

        return $this->success('success', $data);

    }

    public function pvLog(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $page = $request->input('page', 1);
        $limit = 16;
        $status_map =  PvLogs::STATUS_MAP;
        $data = PvLogs::whereMemberId($user->id)
            ->orderBy('id', 'desc')
            ->forPage($page, $limit)
            ->get()
            ->map(function(PvLogs $log)use($status_map){
                $data =  $log->only(['id', 'member_id', 'action', 'amount', 'balance_before','balance_after','remark', 'created_at']);
                $data['action_name'] = isset($status_map[$data['action']])?$status_map[$data['action']]:$data['action'];
                $data['created_at'] = date('Y-m-d H:i', $log->created_at->timestamp);
                return $data;
            })
        ;

        return $this->success('success', $data);
    }


    public function transfer(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'amount' => [
                'required',
            ],
            'number' => 'required',
            'trade_password' => sprintf('required|verify_trad_password:%s', $user->transaction_password)
        ];

        $messages = [
            'required' => '参数不能为空',
            'verify_trad_password' => '交易密码错误',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            Redis::expire($redis_key,3);
            return $this->error($validator->errors()->first());
        }

        try {
            if(config('base.transfer_status') != 1){
                throw new BizException('互转暂未开放');
            }


            $number = $request->input('number');


            $to_user = Member::where('mobile',$number)->orWhere('number',$number)->first();

            if(empty($to_user)){
                throw new BizException('收款人不存在');
            }

            \DB::transaction(function() use ($request, $user,$to_user){
                $amount = $request->input('amount',0);
                if($amount <= 0){
                    throw new BizException('数量有误');
                }
                $member = Member::whereId($user->id)->first();
                if($member->integral < $amount){
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
                IntegralLogs::changeIntegral($amount,$member,0,13,$related_id,$remark);
                $remark = $member->mobile.'转入';
                IntegralLogs::changeIntegral($amount,$to_user,1,2,$related_id,$remark);
            });
            Redis::expire($redis_key,3);
            return $this->success('转账成功');
        } catch (\Throwable $e) {
            Redis::expire($redis_key,3);
            return $this->error($e->getMessage());
        }

    }

    public function withdrawalInfo(){
        $user = \Auth::user();
        $data = \Arr::only($user->toArray(), ['id', 'shop_level','level','mobile','number','integral','is_set_transaction_password']);
        $data['card_names'] = Withdrawal::getCardName();
        $withdrawal = Withdrawal::whereMemberId($data['id'])->orderByDesc('id')->first();
        if($withdrawal){
            $collection_info =  [
                'name' => $withdrawal->name,
                'card_name' => $withdrawal->card_name,
                'card_number' => $withdrawal->card_number,
            ];
        }else{
            $collection_info = [
                'name' => '',
                'card_name' => '',
                'card_number' => ''
            ];
        }

        $data['collection_info'] = $collection_info;


        return $this->success('操作成功', $data);
    }

    public function withdrawal(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'amount' => [
                'required',
            ],
            'name' => 'required',
            'card_name' => 'required',
            'card_number' => 'required',
            'trade_password' => sprintf('required|verify_trad_password:%s', $user->transaction_password)
        ];

        $messages = [
            'required' => '参数不能为空',
            'verify_trad_password' => '交易密码错误',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            if(config('base.withdrawal_status') != 1){
                throw new BizException('提现暂未开放');
            }

            $amount = $request->input('amount',0);
            $min_limit = config('base.transfer_min_limit');
            if($amount < $min_limit){
                throw new BizException('最少提现金额为'.$min_limit);
            }



            \DB::transaction(function() use ($request, $user){
                $amount = $request->input('amount',0);
                if($amount <= 0){
                    throw new BizException('数量有误');
                }
                $member = Member::whereId($user->id)->first();
                if($member->integral < $amount){
                    throw new BizException('数量不足');
                }
                //生成提现记录
                $withdrawal = new Withdrawal();
                $withdrawal->member_id = $member->id;
                $withdrawal->status = 0;
                $withdrawal->amount = $amount;
                $withdrawal->fee = 0;
                $withdrawal->actual_amount = $amount;
                $withdrawal->amount = $amount;
                $withdrawal->name = $request->input('name');
                $withdrawal->card_name = $request->input('card_name');
                $withdrawal->card_number = $request->input('card_number');
                $withdrawal->save();
                $related_id = $withdrawal->id;
                //数量变动
                IntegralLogs::changeIntegral($amount,$member,0,12,$related_id);

            });
            return $this->success('提交成功');
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }

    }


    public function pushDikouquan(Request $request)
    {
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'amount' => [
                'required',
            ],
            'trade_password' => sprintf('required|verify_trad_password:%s', $user->transaction_password)
        ];

        $messages = [
            'required' => '参数不能为空',
            'verify_trad_password' => '交易密码错误',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            \DB::transaction(function() use ($request, $user){
                $amount = $request->input('amount',0);
                if($amount <= 0){
                    throw new BizException('数量有误');
                }
                $member = Member::whereId($user->id)->first();
                if($member->dikouquan_k < $amount){
                    throw new BizException('数量不足');
                }
                //生成推送记录
                $push_integral = new PushDikouquan();
                $push_integral->member_id = $member->id;
                $push_integral->status = 1;
                $push_integral->amount = $amount;
                $push_integral->dikou_amount = $amount;
                $push_integral->save();
                $related_id = $push_integral->id;
                //数量变动
                DikouquanLog::changeIntegralK($amount,$member,0,11,$related_id);
                //加入推送订单
                PushOrder::pushDikouquan($member,$push_integral);
            });
            return $this->success('提交成功');
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }

    }

    public function dikouquanTransfer(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'amount' => [
                'required',
            ],
            'number' => 'required',
            'trade_password' => sprintf('required|verify_trad_password:%s', $user->transaction_password)
        ];

        $messages = [
            'required' => '参数不能为空',
            'verify_trad_password' => '交易密码错误',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            Redis::expire($redis_key,3);
            return $this->error($validator->errors()->first());
        }

        try {
            if(config('base.transfer_status') != 1){
                throw new BizException('互转暂未开放');
            }


            $number = $request->input('number');

            $to_user = Member::where('is_disabled','<',9)->Where(function ($query)use($number){
                $query->where('mobile',$number)->orWhere('number',$number);
            })->first();

            if(empty($to_user)){
                throw new BizException('收款人不存在');
            }

            \DB::transaction(function() use ($request, $user,$to_user){
                $amount = $request->input('amount',0);
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
                DikouquanLog::changeIntegralK($amount,$member,0,14,$related_id,$remark);
                $remark = $member->mobile.'转入';
                DikouquanLog::changeIntegralK($amount,$to_user,1,4,$related_id,$remark);
            });
            Redis::expire($redis_key,3);
            return $this->success('转账成功');
        } catch (\Throwable $e) {
            Redis::expire($redis_key,3);
            return $this->error($e->getMessage());
        }
    }

    public function dikouquanLog(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $page = $request->input('page', 1);
        $limit = 16;
        $status_map =  DikouquanLog::STATUS_MAP;
        $data = DikouquanLog::whereMemberId($user->id)
            ->orderBy('id', 'desc')
            ->forPage($page, $limit)
            ->get()
            ->map(function(DikouquanLog $log)use($status_map){
                $data =  $log->only(['id', 'member_id', 'action', 'amount', 'balance_before','balance_after','remark', 'created_at']);
                $data['action_name'] = isset($status_map[$data['action']])?$status_map[$data['action']]:$data['action'];
                $data['created_at'] = date('Y-m-d H:i', $log->created_at->timestamp);
                return $data;
            })
        ;

        return $this->success('success', $data);

    }


    public function push(Request $request)
    {
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'amount' => [
                'required',
            ],
            'trade_password' => sprintf('required|verify_trad_password:%s', $user->transaction_password)
        ];

        $messages = [
            'required' => '参数不能为空',
            'verify_trad_password' => '交易密码错误',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try {
            \DB::transaction(function() use ($request, $user){
                $amount = $request->input('amount',0);
                if($amount <= 0){
                    throw new BizException('数量有误');
                }
                $member = Member::whereId($user->id)->first();
                if($member->integral < $amount){
                    throw new BizException('数量不足');
                }
                //生成推送记录
                $push_integral = new PushIntegral();
                $push_integral->member_id = $member->id;
                $push_integral->status = 1;
                $push_integral->amount = $amount;
                $push_integral->star_amount = bcmul($amount,100);
                $push_integral->save();
                $related_id = $push_integral->id;
                //数量变动
                IntegralLogs::changeIntegral($amount,$member,0,11,$related_id);
                //加入推送订单
                PushOrder::pushIntegral($member,$push_integral);
            });
            return $this->success('提交成功');
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }

    }
}
