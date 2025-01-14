<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\CheckWithdraw;
use App\Withdrawal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class WithdrawalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '提现列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Withdrawal());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->expandFilter();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            if($this->row->status == 0 && Admin::user()->can('check-withdraw')){
                $actions->add(new CheckWithdraw());
            }

        });

        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('member_id', '账号ID');
                $filter->contains('member.number', '账号');
                $filter->equal('name', __('Name'));
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('card_number', __('Card number'));
                $filter->equal('status', '状态')->select(Withdrawal::STATUS_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('status', __('Status'))->using(Withdrawal::STATUS_MAP);
        $grid->column('amount', __('Amount'));
        $grid->column('fee', __('Fee'));
        $grid->column('actual_amount', __('Actual amount'));
        $grid->column('name', __('Name'));
        $grid->column('card_name', __('Card name'));
        $grid->column('card_number', __('Card number'));
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
        $show = new Show(Withdrawal::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('status', __('Status'));
        $show->field('amount', __('Amount'));
        $show->field('fee', __('Fee'));
        $show->field('actual_amount', __('Actual amount'));
        $show->field('name', __('Name'));
        $show->field('card_name', __('Card name'));
        $show->field('card_number', __('Card number'));
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
        $form = new Form(new Withdrawal());

        $form->number('member_id', __('Member id'));
        $form->number('status', __('Status'));
        $form->decimal('amount', __('Amount'));
        $form->decimal('fee', __('Fee'));
        $form->decimal('actual_amount', __('Actual amount'));
        $form->text('name', __('Name'));
        $form->text('card_name', __('Card name'));
        $form->text('card_number', __('Card number'));

        return $form;
    }
}
