<?php

namespace App\Jobs;

use App\Level;
use App\Member;
use App\PostSaveMember;
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
                case 4:
                case 9:
                case 10:
                    $content = [
                        'amount' => $val[1]??0,
                    ];
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
