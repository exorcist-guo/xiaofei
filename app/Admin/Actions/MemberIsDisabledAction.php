<?php

namespace App\Admin\Actions;

use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;

class MemberIsDisabledAction extends RowAction
{

    public function name()
    {
        if($this->row->is_disabled == 1) {
            return '解除封号';
        }

        return '封禁账号';
    }

    public function handle(Member $model)
    {


        if($model->is_disabled == 1) {
            $model->is_disabled = 0;
        } else {
            $model->is_disabled = 1;
        }
        $model->save();

        return $this->response()->success('操作成功')->refresh();
    }

    public function dialog()
    {
        $message = '此操作将影响用户登录系统，是否确认？';

        $this->confirm($message);
    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('disable-member')) {
            return false;
        }

        return true;
    }

}