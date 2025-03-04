<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class AdminSaveMemberAction extends RowAction
{
    public $name = '修改信息';

    public function handle(Member $user, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }

            $data = $request->input();
            if($data['mobile'] == $user->mobile && $data['real_name'] == $user->real_name && $data['id_number'] == $user->id_number && empty($data['password']) && empty($data['transaction_password'])){
                throw new BizException('未修改数据');
            }
            if($data['id_number'] != $user->id_number){

                $is_user = Member::where('is_disabled','<',9)->Where('id_number',$data['id_number'])->first();
                if($is_user){
                    throw new BizException('该证件号已被注册');
                }

            }

            $result = ChangeOrder::saveMember($user,$data);
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
        $this->select('nation','国家')->options(Member::getNations())->default(1)->rules('required');
        $this->select('certificate_type','证件类型')->options(Member::getNtlw())->default($model->certificate_type)->rules('required');
        $this->text('mobile','注册号:')->default($model->mobile)->rules('required');
        $this->text('real_name','姓名:')->default($model->real_name);
        $this->text('id_number','证件号:')->default($model->id_number);
        $this->text('password','登录密码:')->default('');
        $this->text('transaction_password','操作密码:')->default('');

    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('save-member')) {
            return false;
        }

        return true;
    }
}
