<?php

namespace App\Admin\Actions\Batch;


use App\Exceptions\BizException;

use App\IntegralLogs;
use App\Jobs\ChangeOrderJob;
use App\Member;
use App\Withdrawal;
use Encore\Admin\Actions\BatchAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BatchCheckWithdraw extends BatchAction
{
    public $name = '批量审核';

    public function handle(Collection $collection, Request $request)
    {
        try {
            $redis_key = 'batch_withdrawal_lock';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }

            \DB::transaction(function() use($collection, $request){
                $status = $request->input('withdrawal_status', 0);
                $notes = $request->input('notes', '');

                if($status == 0){
                    throw new \Exception('清选择审核状态');
                }

                foreach ($collection as $model) {
                    if($model->status != 0){
                        throw new BizException('无法审核该订单ID:'.$model->id);
                    }
                    $w = Withdrawal::where('id',$model->id)->first();
                    if($w->status == 0){
                        $model->status = $status;
                        $model->notes = $notes;
                        if($status == 1){
                            //驳回
                            $user = Member::where('id',$model->member_id)->first();
                            IntegralLogs::changeIntegral($w->amount,$user,1,3,$w->id,'提现驳回');

                        }
                        $model->save();
                    }

                }
            });
            foreach ($collection as $model) {
                ChangeOrderJob::dispatch($model->id);
            }
            Redis::expire($redis_key,2);
        } catch (\Throwable $e) {
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }
        return $this->response()->success('操作成功')->refresh();
    }

    public function form()
    {
        $this->radio('withdrawal_status','审核')->options(['2'=> '已打款',1=>'驳回']);
        $this->textarea('notes','原因');
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('check_save-member')) {
            return false;
        }

        return true;
    }

}
