<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\MemberTree;
use Encore\Admin\Tree;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form;

class MemberTreeController extends Controller
{
    public function index(Content $content)
    {
        $tree = new Tree(new MemberTree());
        $tree->disableSave();
        $tree->disableCreate();

        // 添加搜索框
        $form = new Form();
        $form->text('number', '账号')->placeholder('请输入账号进行搜索');

        // 设置搜索条件
        $tree->query(function ($model) use ($form) {
            $search = request()->get('search');
            if ($search) {
                return $model->where('name', 'like', '%' . $search . '%');
            }
            return $model;
        });

        return $content
            ->header('会员树')
            ->body($form->render())
            ->body($tree);
    }
}
