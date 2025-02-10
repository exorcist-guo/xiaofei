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
                $path = '';
                $group_number = $post_member->group_number;
                $pid_shop_member_id = 0;
                $shop_member_id = 0;
                if($post_member->pid_id_number){

                    $parent = Member::whereNumber($post_member->pid_id_number)->where('is_disabled','<',9)->first();
                    if($parent){
                        $pid = $parent->id;
                        $deep =  $parent->deep + 1;
                        $group_number = $parent->group_number;
                        if($parent->path){
                            $path = $parent->path . $pid.'/';
                        }else{
                            $path = '/'.$pid.'/';
                        }
                        $pid_shop_member_id = $parent->pid_shop_member_id;
                        $shop_member_id = $parent->shop_member_id;
                    }





                    if(empty($pid)){
                        $post_member->status = 6;
                        $pid = 0;
                        $path = '';
                        $pid_shop_member_id = 0;
                        $error .= '上级未找到';
                    }

                }
                //导入会员
                $data = [
                    'mobile' => $post_member->mobile,
                    'level' => 0,
                    'deep' => $deep,
                    'path' => $path,
                    'shop_level' => 0,
                    'group_number' => $group_number,
                    'password' => \Hash::make(substr($post_member->mobile,-6)),
                    'pid' => $pid,
                    'pid_shop_member_id' => $pid_shop_member_id,
                    'shop_member_id' => $shop_member_id,
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
                //验证数据
                $post_member->status = 4;
                if(empty($post_member->number)){
                    $post_member->status = 3;
                    $error .= '账号不能为空';
                }

                if($post_member->pid_id_number){
                    $pp = PostMember::where('status','>',1)->where('number',$post_member->pid_id_number)->first();
                    $pp2 = Member::whereNumber($post_member->pid_id_number)->where('is_disabled','<','9')->first();



                    if(empty($pp) && empty($pp2)){
                        $post_member->status = 3;
                        $error .= '上级推荐人不存在。';
                    }

                }else{
                    if(empty($post_member->group_number)){
                        $post_member->status = 3;
                        $error .= '顶级组号不能为空';
                    }else{
                        $zh = Member::where('group_number',$post_member->group_number)->where('is_disabled','<','9')->first();
                        if($zh){
                            $post_member->status = 3;
                            $error .= '组号与已有的重复';
                        }
                        if($post_member->group_number < 1000 || $post_member->group_number > 9999) {
                            $post_member->status = 3;
                            $error .= '组号范围必须是1000-9999';
                        }
                    }
                }

                $pp = PostMember::where('status','>',1)->where('mobile',$post_member->mobile)
                    ->where('id','<>',$post_member->id)
                    ->first();
                $pp2 = Member::where('is_disabled','<',9)->where('mobile',$post_member->mobile)->first();
                if($pp || $pp2){
                    $post_member->status = 3;
                    $error .= '该邮箱已经存在';
                }

                $pp = PostMember::where('status','>',1)
                    ->where('number',$post_member->number)
                    ->where('id','<>',$post_member->id)
                    ->first();
                $pp2 = Member::where('is_disabled','<',9)->where('number',$post_member->number)->first();
                if($pp || $pp2){
                    $post_member->status = 3;
                    $error .= '该账号已经存在';
                }


            }

            $post_member->error = $error;
            $post_member->save();
        }elseif($data){
            $post_member = new PostMember();
            $post_member->status = 4;
            $post_member->pici = $data['pici'];
            $post_member->mobile = $data['mobile'];
            $post_member->pid_id_number = $data['pid_id_number']??'';
            $post_member->real_name = $data['real_name'];
            $post_member->id_number = $data['id_number'];
            $post_member->group_number = $data['group_number'];
            $post_member->number = $data['number'];
            if(empty($post_member->number)){
                $post_member->status = 3;
                $error .= '账号不能为空';
            }

            if($post_member->pid_id_number){
               $pp = PostMember::where('status','>',1)->where('number',$post_member->pid_id_number)->first();
               $pp2 = Member::whereNumber($post_member->pid_id_number)->where('is_disabled','<','9')->first();
               if(empty($pp) && empty($pp2)){
                   $post_member->status = 3;
                   $error .= '上级推荐人不存在';
               }
            }else{
                if(empty($post_member->group_number)){
                    $post_member->status = 3;
                    $error .= '顶点号不能为空';
                }else{
                    $zh = Member::where('group_number',$post_member->group_number)->where('is_disabled','<','9')->first();
                    if($zh){
                        $post_member->status = 3;
                        $error .= '订点号与已有的重复';
                    }
                    if($post_member->group_number < 1000 || $post_member->group_number > 9999) {
                        $post_member->status = 3;
                        $error .= '订点号范围必须是1000-9999';
                    }
                }
            }

//            $a = Member::isIdCard($post_member->id_number);
//            if(!$a){
//                $post_member->status = 3;
//                $error .= '身份证号异常';
//            }
            $pp = PostMember::where('status','>',1)->where('mobile',$post_member->mobile)->first();
            $pp2 = Member::where('is_disabled','<',9)->where('mobile',$post_member->mobile)->first();
            if($pp || $pp2){
                $post_member->status = 3;
                $error .= '该邮箱已经存在';
            }

            $pp = PostMember::where('status','>',1)->where('number',$post_member->number)->first();
            $pp2 = Member::where('is_disabled','<',9)->where('number',$post_member->number)->first();
            if($pp || $pp2){
                $post_member->status = 3;
                $error .= '该账号已经存在';
            }

            $post_member->error = $error;
            $post_member->save();
        }
    }
}
