<?php

namespace App\Admin\Controllers;

use App\Proclamation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class ProclamationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公告列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Proclamation());

        $grid->model()
            ->orderByDesc('sort')
            ->orderByDesc('id')
        ;

//        $grid->disableCreateButton();
        $grid->expandFilter();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();

        $grid->filter(function(Grid\Filter $filter){

            $filter->column(1/2, function(Grid\Filter $filter){

                $filter->contains('title', '标题');
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('issue', '已发布')->select([1=>'已发布', 0=>'待发布']);
                $filter->between('created_at',__('Created at'))->datetime();
            });

        });

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
        $grid->column('issue', __('发布？'))->switch([
            'on' => ['value' => 1, 'text' => '已发布', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '待发布', 'color' => 'danger']
        ]);

//        $grid->column('is_hot', __('置顶？'))->switch([
//            'on' => ['value' => 1, 'text' => '已置顶', 'color' => 'danger'],
//            'off' => ['value' => 0, 'text' => '未置顶', 'color' => 'default']
//        ]);

        $grid->column('sort', '排序')->editable();

        $grid->column('abstract', __('Abstract'))->display(function($abstract){
            return Str::limit($abstract, 100, '...');
        });



        $grid->column('created_at', __('Created at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Proclamation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('abstract', __('Abstract'));
        $show->field('description', __('Description'));

        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Proclamation());

        $form->text('title', __('Title'));
        $form->switch('issue', __('是否发布'))->states([
            'on' => ['value' => 1, 'text' => '已发布', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '待发布', 'color' => 'danger']
        ]);


        $form->number('sort', '排序')->default(10);

        $form->textarea('abstract', __('Abstract'));
        $form->ckeditor('description',__('Description'))->options(['lang' => 'zh-CN', 'height' => 300]);

        return $form;
    }
}
