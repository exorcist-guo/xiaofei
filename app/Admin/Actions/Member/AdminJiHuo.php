<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;

use App\Member;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminJiHuo extends RowAction
{
    public $name = '激活设置';

    public function handle(Member $user, Request $request)
    {

        try {
            $redis_key = 'check_member_jshuo_lock'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex', 30, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $is_chuxiao = $request->input('is_chuxiao', 0);
            if($is_chuxiao == $user->is_chuxiao){
                throw new BizException('未修改状态');
            }
            if($is_chuxiao == 0 && $user->divvy_pv >= 400){
                throw new BizException('用户消费激活，无法设置为未激活');
            }
            $result = ChangeOrder::saveIsChuxiao($user,$is_chuxiao);

            if($result){
                Redis::expire($redis_key,2);
                return $this->response()->success('已提交等待审核')->refresh();
            }else{
                throw new BizException('操作失败');
            }


        } catch (\Exception $e) {
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }
        return $this->response()->success('操作成功')->refresh();
    }

    public function form()
    {

        $this->radio('is_chuxiao','激活')->options(['1'=> '激活',0=>'未激活'])
            ->help('消费满400的，无法设置为未激活')
        ;

    }

    public function authorize($user, $model)
    {
        return true;
    }
}
