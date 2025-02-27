<?php

namespace App\Admin\Controllers;

use App\PvOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PvOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '营业额订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PvOrder());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->expandFilter();
        $grid->disableActions();

        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('id', __('Id'));
                $filter->contains('member.number', '账号');

            });
            $filter->column(1/2, function(Grid\Filter $filter){

                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
//        $grid->column('member_id', __('Member id'));
        $grid->column('mobile', __('Mobile'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));
        $grid->column('amount', __('Amount'));
        $grid->column('cash_amount', __('Cash amount'));
        $grid->column('point', '环宇星');
        $grid->column('dikou', '消费券');
        $grid->column('order_no', __('Order no'));
        $grid->column('status', __('Status'))->using(PvOrder::STATUS_MAP);
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
        $show = new Show(PvOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('mobile', __('Mobile'));
        $show->field('amount', __('Amount'));
        $show->field('cash_amount', __('Cash amount'));
        $show->field('order_no', __('Order no'));
        $show->field('status', __('Status'));
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
        $form = new Form(new PvOrder());
//
//        $form->number('member_id', __('Member id'));
//        $form->mobile('mobile', __('Mobile'));
//        $form->decimal('amount', __('Amount'));
//        $form->decimal('cash_amount', __('Cash amount'));
//        $form->text('order_no', __('Order no'));
//        $form->number('status', __('Status'));

        return $form;
    }
}
