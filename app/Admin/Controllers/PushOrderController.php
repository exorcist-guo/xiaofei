<?php

namespace App\Admin\Controllers;

use App\PushOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PushOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '推送列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PushOrder());

        $grid->column('id', __('Id'));
        $grid->column('status', __('Status'));
        $grid->column('order_no', __('Order no'));
        $grid->column('type', __('Type'));
        $grid->column('related_id', __('Related id'));
        $grid->column('content', __('Content'));
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
        $show = new Show(PushOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('order_no', __('Order no'));
        $show->field('type', __('Type'));
        $show->field('related_id', __('Related id'));
        $show->field('content', __('Content'));
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
        $form = new Form(new PushOrder());

        $form->number('status', __('Status'));
        $form->text('order_no', __('Order no'));
        $form->text('type', __('Type'));
        $form->number('related_id', __('Related id'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
