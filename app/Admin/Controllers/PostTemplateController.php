<?php

namespace App\Admin\Controllers;

use App\Model\PostTemplate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostTemplateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '导入模版下载';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PostTemplate());
        $grid->disableRowSelector();
        
        $grid->column('id', __('Id'));
        $grid->column('name', __('Namec'));
        $grid->column('mobanurl', __('Mobanurl'))->downloadable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(PostTemplate::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Namec'));
        $show->field('mobanurl', __('Mobanurl'));
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
        $form = new Form(new PostTemplate());

        $form->text('name', __('Namec'));

        $form->file('mobanurl',__('Mobanurl'));
        return $form;
    }
}
