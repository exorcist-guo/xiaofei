<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminSavePidAction extends RowAction
{
    public $name = '修改上级';

    public function handle(Member $user, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }

            $mobile = $request->input('mobile','');
            $p_user = Member::whereMobile($mobile)
                ->where('is_disabled','<',9)
                ->first();
            if(empty($p_user)){
                throw new BizException('输入手机号不存在');
            }
            if($p_user->id == $user->pid){
                throw new BizException('上级未变动');
            }
            //验证死循环
            $user_ids = Member::getAllSpreadUids($p_user->id);
            if(in_array($user->id,$user_ids)){
                throw new BizException('无法把下级设置为上级');
            }

            $result = ChangeOrder::savePid($user,$p_user);

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
        $this->text('mobile','上级手机号:')->default('')->rules('required');


    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('save-pid')) {
            return false;
        }

        return true;
    }
}
