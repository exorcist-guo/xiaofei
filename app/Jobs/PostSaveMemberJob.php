<?php

namespace App\Jobs;

use App\Level;
use App\Member;
use App\PostSaveMember;
use App\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostSaveMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $error = '';
        if($data){
            $post_save_member = new PostSaveMember();
            $post_save_member->status = 4;
            $post_save_member->type =  $data['type'];
            $post_save_member->pici = $data['pici'];
            $post_save_member->admin_id = $data['admin_id'];
            $post_save_member->content = '';
            $val = $data['val'];
            $post_save_member->val = json_encode($data['val']); //原始数据
            if(empty($data['val'][0])){
                $error .= '账号不能为空';
            }
            $user = Member::whereNumber($data['val'][0])->where('is_disabled','<',9)->first();
            if(empty($user)){
                $error .= '会员不存在';
            }

            if(!isset($val[1])){
                $error .= '缺少参数';
            }

            $post_save_member->member_id = $user->id;
            switch ($post_save_member->type){
//                case 1:
//
//                    break;
                case 2:
                    $levels = Level::getLevels();
                    if(isset($levels[$val[1]])){
                        $content = [
                            'level_before' => $user->level,
                            'level_after' => $val[1]
                        ];
                        $content = json_encode($content);
                        $post_save_member->content = $content;
                    }else{
                        $error .= "等级{$val[1]}不存在";
                    }
                    break;
                case 3:

                case 9:
                case 10:
                    $content = [
                        'amount' => $val[1]??0,
                    ];
                    $content = json_encode($content);
                    $post_save_member->content = $content;
                    break;
                case 4:

                    $content = [
                        'amount' => $val[1]??0,
                        'remark' => '导入增加',
                    ];
                    if($content['amount'] < 0){
                        $error .= "营业额不能减少";
                    }
                    $content = json_encode($content);
                    $post_save_member->content = $content;

                    break;
                case 5:
                    $is_status= Member::IS_DISABLED_MAP;
                    if(isset($is_status[$val[1]])){
                        $content = [
                            'status_before' => $user->is_disabled,
                            'status_after' => $is_status
                        ];
                        $content = json_encode($content);
                        $post_save_member->content = $content;
                    }else{
                        $error .= "状态{$val[1]}不存在";
                    }
                    break;
                case 11:

                    $content = [
                        'amount' => $val[1]??0,
                        'remark' => '导入增加',
                    ];
                    if($content['amount'] < 0){
                        $content['remark'] = '导入减少';
                    }
                    $content = json_encode($content);
                    $post_save_member->content = $content;

                    break;
                case 21:
                    //提现订单审核
                    $order_no = trim($val[1]);
                    $w = Withdrawal::where('order_no',$order_no)->first();
                    $post_save_member->order_no = $order_no;

                    if(empty($w)){
                        $error .= "提现订单：{$order_no}不存在";
                    }else{
                        if($w->status != 0){
                            $error .= "该订单不是待审核状态";
                        }
                    }
                    if($w && $user->id != $w->member_id){
                        $error .= "用户账号和提现订单用户账号不匹配";
                    }
                    $status_name = trim($val[2]);
                    if($status_name == '已打款'){
                        $status = 2;
                    }elseif($status_name == '打款失败'){
                        $status = 4;
                    }else{
                        $status = '';
                        $error .= "状态未识别";
                    }
                    $content = [
                        'status' => $status,
                        'error_msg2' => trim($val[3]),
                    ];

                    $content = json_encode($content);
                    $post_save_member->content = $content;

                    break;

                default :
                    $error .= "不能修改{$val[0]}";
            }
            if($error){
                $post_save_member->status = 3;
                $post_save_member->error = $error;
            }
            $post_save_member->save();
        }

    }
}
