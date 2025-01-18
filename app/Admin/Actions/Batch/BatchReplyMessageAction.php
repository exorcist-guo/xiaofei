<?php

namespace App\Admin\Actions\Batch;


use App\Exceptions\BizException;

use App\Jobs\ChangeOrderJob;
use Encore\Admin\Actions\BatchAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BatchReplyMessageAction extends BatchAction
{
    public $name = '批量回复';

    public function handle(Collection $collection, Request $request)
    {
        try {
            $redis_key = 'batch_reply_message_lock_batch';
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $reply = $request->input('reply', '');
            if(empty($reply)){
                throw new BizException('回复类容不能为空');
            }
            \DB::transaction(function () use ($request, $collection,$reply) {


                foreach ($collection as $model) {
                    if($model->status == 0){
                        $model->reply = $reply;
                        $model->status = 1;
                        $model->admin_id = ADMIN_ID;
                        $model->save();
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
        $this->textarea('reply','回复类容');
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('check_save-member')) {
            return false;
        }

        return true;
    }

}
