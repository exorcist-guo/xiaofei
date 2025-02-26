<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Batch\BatchCheckWithdraw;
use App\Admin\Actions\CheckWithdraw;
use App\Withdrawal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class WithdrawalDsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '发放失败列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Withdrawal());
        $grid->model()->where('status',4)->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->expandFilter();
        $grid->disableActions();


        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
//                $filter->equal('member_id', '账号ID');
                $filter->contains('member.number', '账号');
                $filter->equal('name', __('Name'));
                $filter->equal('card_number', __('Card number'));
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('order_no','提现单号');

                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
//        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));
        $grid->column('order_no', '提现单号');
        $grid->column('status', __('Status'))->using(Withdrawal::STATUS_MAP);
        $grid->column('amount', __('Amount'));
        $grid->column('fee', __('Fee'));
        $grid->column('actual_amount', __('Actual amount'));
        $grid->column('name', __('Name'));
        $grid->column('card_name', __('Card name'));
        $grid->column('card_number', __('Card number'));
        $grid->column('notes', __('Notes'));
        $grid->column('error_msg', __('Error Msg'));
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


        $form->text('card_number', __('Card number'));

        return $form;
    }
}
