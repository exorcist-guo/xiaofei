<?php

namespace App\Jobs;

use App\Member;
use App\PostMember;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PostMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $data;

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
        if(isset($data['id'])){
            $post_member = PostMember::where('id',$data['id'])->first();
            if($post_member->status == 4){
                $pid = 0;
                $deep = 0;
                $pid_shop_member_id = 0;
                if($post_member->pid_id_number){
                    $pp = PostMember::where('status','>',1)->where('id_number',$post_member->pid_id_number)->first();
                    if($pp){
                        $parent = Member::whereNumber($pp->number)->first();
                        $pid = $parent->pid;

                        $pid_shop_member_id = $parent->pid_shop_member_id;
                    }
                    if(empty($pid)){
                        $post_member->status = 6;
                        $pid = 0;
                        $pid_shop_member_id = 0;
                        $error .= '上级未找到';
                    }

                }
                //导入会员
                $data = [
                    'mobile' => $post_member->mobile,
                    'level' => 0,
                    'deep' => $deep,
                    'shop_level' => 0,
                    'password' => \Hash::make(substr($post_member->id_number,-6)),
                    'pid' => $pid,
                    'pid_shop_member_id' => $pid_shop_member_id,
                    'number' => $post_member->number,
                    'real_name' => $post_member->real_name,
                    'id_number' => $post_member->id_number,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $id = DB::table('members')->insertGetId($data);
                if($id){
                    $post_member->status = 7;
                }else{
                    $post_member->status = 6;
                }




            }elseif(in_array($post_member->status,[0,3,6])){
                if($post_member->pid_id_number){
                    $pp = PostMember::where('status','>',1)->where('id_number',$post_member->pid_id_number)->first();
                    if(empty($pp)){
                        $post_member->status = 3;
                        $error .= '上级推荐人不存在。';
                    }

                }
                $a = Member::isIdCard($post_member->id_number);
                if(!$a){
                    $post_member->status = 3;
                    $error .= '身份证号异常。';
                }
            }

            $post_member->error = $error;
            $post_member->save();
        }elseif($data){
            $post_member = new PostMember();
            $post_member->status = 4;
            $post_member->pici = $data['pici'];
            $post_member->mobile = $data['mobile'];
            $post_member->pid_id_number = $data['pid_id_number'];
            $post_member->real_name = $data['real_name'];
            $post_member->id_number = $data['id_number'];
            $post_member->number = Member::getTradeNo();
            if($post_member->pid_id_number){
               $pp = PostMember::where('status','>',1)->where('id_number',$post_member->pid_id_number)->first();
               if(empty($pp)){
                   $post_member->status = 3;
                   $error .= '上级推荐人不存在';
               }

            }
            $a = Member::isIdCard($post_member->id_number);
            if(!$a){
                $post_member->status = 3;
                $error .= '身份证号异常';
            }
            $pp = PostMember::where('status','>',1)->where('id_number',$post_member->id_number)->first();
            if($pp){
                $post_member->status = 3;
                $error .= '该身份证已存在';
            }
            $post_member->error = $error;
            $post_member->save();
        }
    }
}
