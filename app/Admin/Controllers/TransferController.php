<?php

namespace App\Admin\Controllers;

use App\Transfer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TransferController extends AdminController
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
        $grid = new Grid(new Transfer());

        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->expandFilter();
        $grid->disableActions();

        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('member_id', '账号ID');
                $filter->contains('member.number', '账号');
                $filter->between('created_at',__('Created at'))->datetime();
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('c_member_id', __('C member id'));
                $filter->contains('cmember.number', '收款账号');

            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('c_member_id', __('C member id'));
        $grid->column('cmember.number','收款'. __('Number'));
        $grid->column('amount', __('Amount'));
        $grid->column('fee', __('Fee'));
        $grid->column('actual_amount', __('Actual amount'));
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
        $show = new Show(Transfer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('c_member_id', __('C member id'));
        $show->field('amount', __('Amount'));
        $show->field('fee', __('Fee'));
        $show->field('actual_amount', __('Actual amount'));
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
        $form = new Form(new Transfer());

        $form->number('member_id', __('Member id'));
        $form->number('c_member_id', __('C member id'));
        $form->decimal('amount', __('Amount'));
        $form->decimal('fee', __('Fee'));
        $form->decimal('actual_amount', __('Actual amount'));

        return $form;
    }
}
