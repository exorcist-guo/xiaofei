<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Member;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form; // 引入 Form 类

class MemberTreeV2Controller extends Controller
{

    public function index(Content $content, Request $request)
    {
        $content->title('网络图');


        // 添加搜索表单
        $form = new Form();
        $form->text('number', '账号')->placeholder('请输入账号进行搜索');


        $select = ['id', 'number', 'pid', 'real_name','level'];
        $number = $request->input('number','');
        if ($number) {
            $members = Member::with(['children' => function ($query) {
                $query->select();
            }])->where('number', $number)->select($select)->get();
        } else {
            $members = Member::with(['children' => function ($query) {
                $query->select();
            }])->wherePid(0)->select($select)->get();
        }
        foreach ($members as $member){
            if(!empty($member->children)){
                foreach ($member->children as $child){
                    $childs = Member::with(['children' => function ($query)use($select) {
                        $query->select($select);
                    }])->wherePid($child->id)->select($select)->get();
                    $child->children = $childs;
                }
            }
        }
        $data = $members;
        $content->view('admin.membertree', ['data' => $data,'number'=>$number]);

        return $content;
    }

    public function getMemberData(Request $request)
    {
        $select = ['id', 'number', 'pid', 'real_name','level'];
        $id = $request->input('id');
        if ($id) {
            $members = Member::with(['children' => function ($query)use($select) {
                $query->select($select);
            }])->wherePid($id)->select($select)->get();


            $data = [
                'code' => 0,
                'msg' => '',
                'data' => $members
            ];

        }else{
            $data = [
                'code' => 4,
                'msg' => '',
                'data' => []
            ];
        }
        return $data;
    }
}
