<?php

namespace App\Admin\Controllers;

use App\PushIntegral;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PushIntegralController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '积分推送';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PushIntegral());

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));

        $grid->column('member.number', __('账号'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('status', __('Status'));
        $grid->column('amount', __('Amount'));
        $grid->column('star_amount', __('Star amount'));
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
        $show = new Show(PushIntegral::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('status', __('Status'));
        $show->field('amount', __('Amount'));
        $show->field('star_amount', __('Star amount'));
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
        $form = new Form(new PushIntegral());

        $form->number('member_id', __('Member id'));
        $form->number('status', __('Status'));
        $form->decimal('amount', __('Amount'));
        $form->number('star_amount', __('Star amount'));

        return $form;
    }
}
