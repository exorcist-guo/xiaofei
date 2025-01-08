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
            $parent = Member::whereMobile($pid_mobile)->orWhere('number',$pid_mobile)->first();
            if(empty($parent)){
                throw new BizException('上级用户不存在');
            }
            $user = Member::findByMobile($mobile);
            if($user){
                throw new BizException('该手机号已注册');
            }
            $pid = $parent->id;
            $pid_shop_member_id = $parent->pid_shop_member_id;
            $shop_member_id = $parent->shop_member_id;
            if($parent->path){
                $path = $parent->path . $pid.'/';
            }else{
                $path = '/'.$pid.'/';
            }

            $user = new Member();
            $user->pid = $pid;
            $user->mobile = $mobile;
            $user->pid_shop_member_id = $pid_shop_member_id;
            $user->shop_member_id = $shop_member_id;
            $user->path = $path;
            $user->number = Member::createMemberNumber($shop_member_id);
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
        $this->email('mobile','邮箱')->required();
        $this->text('password','登录密码')->required();
        $this->text('real_name','姓名')->required();
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
