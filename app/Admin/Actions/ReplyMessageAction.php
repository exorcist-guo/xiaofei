<?php

namespace App\Admin\Actions;

use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Member;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis;


class ReplyMessageAction extends RowAction
{

    public $name = '回复';

    public function handle($model, Request $request)
    {

        try {
            $redis_key = 'withdrawal_lock'.$model->id;
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }


            \DB::transaction(function () use ($request, $model) {
                $reply = $request->input('reply', '');
                if(empty($reply)){
                    throw new BizException('回复类容不能为空');
                }
                $model->reply = $reply;
                $model->status = 1;
                $model->save();
            });

        } catch (\Exception $e) {
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }
        return $this->response()->success('操作成功')->refresh();
    }

    public function form($message)
    {

        $this->textarea('reply',__('Reply'))->default($message->reply);

    }

    public function authorize($user, $model)
    {
        return true;
    }
}
