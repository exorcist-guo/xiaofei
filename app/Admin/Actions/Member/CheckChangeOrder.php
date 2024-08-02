<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Jobs\ChangeOrderJob;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CheckChangeOrder extends RowAction
{
    public $name = '审核';

    public function handle(ChangeOrder $model, Request $request)
    {

        try {
            $redis_key = 'check_change_order_lock'.$model->id;
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $status = $request->input('order_status', 0);
            if($status == 0){
                throw new \Exception('清选择审核状态');
            }
            if($model->status != 0){
                throw new \Exception('无法审核该订单');
            }
            $model->status = $status;
            $model->audite_admin_id = ADMIN_ID;
            $result = $model->save();
            if($status == 2 && $result){
                ChangeOrderJob::dispatch($model->id);
            }
            Redis::expire($redis_key,2);
        } catch (\Exception $e) {
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
        return true;
    }
}
