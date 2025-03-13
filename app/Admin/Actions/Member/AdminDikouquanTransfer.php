<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class AdminDikouquanTransfer extends RowAction
{
    public $name = '抵扣券转账';

    public function handle(Member $user, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $to_number = $request->input('to_number','');
            $amount = $request->input('amount',0);
            $amount = abs($amount);
            if($amount > $user->dikouquan_k){
                throw new BizException('用户抵扣券数量不足');
            }


            $to_user = Member::where('number',$to_number)->first();
            if(!$to_user){
                throw new BizException('收款账号不存在');
            }
            if($amount == 0){
                throw new BizException('转账数不能为0');
            }
            if($user->id == $to_user->id){
                throw new BizException('不能给自己转账');
            }

            $result = ChangeOrder::Transfer($user,$amount,$to_user);
            if($result){
                return $this->response()->success('已提交等待审核')->refresh();
            }else{
                throw new BizException('操作失败');
            }
        }catch(\Exception $e){
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }

    }

    public function form(Member $model)
    {

        $this->text('number','转出账号')->default($model->number)->disable();

        $this->text('to_number','收款账号');

        $this->text('amount','转出数量');

    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('dikouquan-transfer')) {
            return false;
        }

        return true;
    }
}
