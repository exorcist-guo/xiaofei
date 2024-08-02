<?php

namespace App\Http\Controllers;

use App\Exceptions\BizException;
use App\Member;
use App\Model\Message;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    use ApiResponseTrait;

    public function messageInfo(){
        $data = Message::TYPE_MAP;
        return $this->success('成功',$data);
    }

    public function messageList(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $page = $request->input('page', 1);
        $limit = 16;
        $type_map =  Message::TYPE_MAP;
        $data = Message::whereMemberId($user->id)
            ->orderBy('id', 'desc')
            ->forPage($page, $limit)
            ->get()
            ->map(function(Message $log)use($type_map){
                $log->type_name = $type_map[$log->type];
                return $log;
            })
        ;

        return $this->success('success', $data);
    }


    public function submit(Request $request){
        /** @var Member $user */
        $user = $request->user();
        $redis_key = 'user_lock'.$user->id;
        if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
            throw new BizException('操作太频繁');
        }
        $rules = [
            'mobile' => [
                'required',
            ],
            'name' => 'required',
            'question' => 'required',
            'type' => 'required',
        ];

        $messages = [
            'required' => '参数不能为空',
            'type.required' => '必须选择问题类型',
            'mobile.required' => '手机号不能为空',
            'name.required' => '姓名不能为空',
            'question.required' => '问题不能为空',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        $mobile = $request->input('mobile');
        $name = $request->input('name');
        $question = $request->input('question');
        $type = $request->input('type');
        $message = new Message();
        $message->member_id = $user->id;
        $message->mobile = $mobile;
        $message->name = $name;
        $message->question = $question;
        $message->type = $type;
        $message->save();

        return  $this->success('提交成功');



    }
}
