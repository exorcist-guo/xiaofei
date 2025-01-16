<?php

namespace App\Admin\Actions\Batch;


use App\Exceptions\BizException;

use App\Jobs\ChangeOrderJob;
use Encore\Admin\Actions\BatchAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BatchCheckChangeOrder extends BatchAction
{
    public $name = '批量审核';

    public function handle(Collection $collection, Request $request)
    {
        try {
            $redis_key = 'check_change_order_lock_batch';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $status = $request->input('order_status', 0);
            if($status == 0){
                throw new BizException('清选择审核状态');
            }
            \DB::transaction(function() use($collection, $request, $status){
                foreach ($collection as $model) {
                    if($model->status != 0){
                        throw new BizException('无法审核该订单:'.$model->id);
                    }
                    $model->status = $status;
                    $model->audite_admin_id = ADMIN_ID;
                    $model->save();
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
        $this->radio('order_status','审核')->options(['1'=> '驳回',2=>'通过']);
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('check_save-member')) {
            return false;
        }

        return true;
    }

}
