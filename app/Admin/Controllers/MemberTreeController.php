<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\MemberTree;
use Encore\Admin\Tree;
use Encore\Admin\Layout\Content;

class MemberTreeController extends Controller
{
    public function index(Content $content)
    {
        $tree = new Tree(new MemberTree());
//        $tree->query(function ($model) {
//            return $model->where('type', 1);
//        });

        return $content
            ->header('树状模型')
            ->body($tree);
    }
}
