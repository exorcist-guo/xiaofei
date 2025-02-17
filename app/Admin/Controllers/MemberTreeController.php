<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\MemberTree;
use Encore\Admin\Tree;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class MemberTreeController extends Controller
{
    public function index(Content $content)
    {
        $tree = new Tree(new MemberTree());
        $tree->disableSave();
        $tree->disableCreate();


        // 添加搜索框
        $form = new Form();
        $form->text('search', '搜索')->placeholder('请输入搜索内容');

        // 设置搜索条件
        $tree->query(function ($model) use ($form) {
            $search = request()->get('search');
            if ($search) {
                return $model->where('number', 'like', $search );
            }
            return $model;
        });

        return $content
            ->header('会员树')
            ->body($form->render())
            ->body($tree);
    }

    public function store(Request $request)
    {
        // 验证请求数据
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 添加其他字段的验证规则
        ]);

        // 创建新记录
        $memberTree = MemberTree::create($validatedData);

        // 返回成功响应
        return redirect()->route('member_trees.index')->with('success', '会员树创建成功');
    }
}
