<?php

namespace App\Admin\Controllers;


use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class AdminAddMember extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '新增用户';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {

        $pid_mobile = $request->input('pid_mobile','');
        $mobile = $request->input('mobile','');
        $real_name = $request->input('real_name','');
        $id_number = $request->input('id_number','');
        $password = $request->input('password ','');

        try{
            $p_user = Member::whereMobile($pid_mobile)->orWhere('number',$pid_mobile)->first();
            if(empty($p_user)){
                throw new BizException('上级用户不存在');
            }
            $user = Member::findByMobile($mobile);
            if($user){
                throw new BizException('该手机号已注册');
            }
            $user = new Member();
            $user->pid = $p_user->id;
            $user->mobile = $mobile;
            $user->number = Member::getTradeNo();
            $user->real_name = $real_name;
            $user->id_number = $id_number;
            $user->password = \Hash::make($password);
            $user->save();


        }catch (\Exception $e){
            admin_error($e->getMessage());
            return back()->withInput();
        }

        admin_success('添加成功');
        return redirect(sprintf('%s/members',config('admin.route.prefix')));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('pid_mobile','上级手机号/账号')->required();
        $this->email('mobile','手机号')->required();
        $this->text('real_name','登录密码')->required();
        $this->text('password','姓名')->required();
        $this->text('id_number','身份证号')->required();
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return old();
    }


}
