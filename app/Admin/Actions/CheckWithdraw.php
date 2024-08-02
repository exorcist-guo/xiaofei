<?php

namespace App\Admin\Actions;

use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Member;
use App\Withdrawal;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis;


class CheckWithdraw extends RowAction
{

    public $name = '提现审核';

    public function handle($model, Request $request)
    {

        try {
            $redis_key = 'withdrawal_lock'.$model->id;
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }


            \DB::transaction(function () use ($request, $model) {
                $status = $request->input('status', 0);
                if($status == 0){
                    throw new \Exception('清选择审核状态');
                }
                $w = Withdrawal::where('id',$model->id)->first();
                if($w->status !== 0){
                    throw new \Exception('已处理');
                }
                $model->status = $status;
                if($status == 1){
                    //驳回
                    $user = Member::where('id',$model->member_id)->first();
                    IntegralLogs::changeIntegral($w->amount,$user,1,3,$w->id,'提现驳回');

                }
                $model->save();
            });

        } catch (\Exception $e) {
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }
        return $this->response()->success('操作成功')->refresh();
    }

    public function form()
    {

        $this->radio('status','审核')->options(['2'=> '已打款',1=>'驳回']);

    }

    public function authorize($user, $model)
    {
        return true;
    }
}
