<?php

namespace App\Admin\Actions\Batch;


use App\Exceptions\BizException;

use App\Jobs\ChangeOrderJob;
use App\Member;
use Encore\Admin\Actions\BatchAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BatchCheckMember extends BatchAction
{
    public $name = '批量审核';

    public function handle(Collection $collection, Request $request)
    {
        try {
            $redis_key = 'batch_check_change_member_lock';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $msg = $request->input('msg', '');
            $status = $request->input('order_status', 0);
            if($status == 0){
                throw new \Exception('清选择审核状态');
            }

            \DB::transaction(function () use ($collection,$msg,$status) {


                foreach ($collection as $model) {
                    if($model->status == 0){
                        $model->is_disabled = $status;
                        $model->audite_admin_id = ADMIN_ID;
                        $model->msg = $msg;
                        $model->save();
                        if($status == 6){
                            Member::whereId($model->member_id)->update(['is_disabled'=>0]);
                        }elseif($status == 8){
                            Member::whereId($model->member_id)->update(['is_disabled'=>$status]);
                        }
                    }

                }
            });

            Redis::expire($redis_key,2);
        } catch (\Throwable $e) {
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }
        return $this->response()->success('操作成功')->refresh();
    }

    public function form()
    {
        $this->radio('order_status','审核')->options(['8'=> '驳回',6=>'通过']);
        $this->text('msg','原因');
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('check_save-member')) {
            return false;
        }

        return true;
    }

}
