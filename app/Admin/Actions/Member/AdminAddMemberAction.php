<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminAddMemberAction extends RowAction
{
    public $name = '修改会员信息';

    public function handle(Member $model, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$model->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }

            $tostatus = $request->input('to_status');
            if($tostatus == $model->is_disabled){
                throw new BizException('未变动状态');
            }


            $result = ChangeOrder::adjustMemberStatus($model,$tostatus);
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

    public function form()
    {
        $this->radio('to_status', '用户状态')
            ->options(Member::IS_DISABLED_MAP)

            ->rules('required');
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('change-level')) {
            return false;
        }

        return true;
    }
}
