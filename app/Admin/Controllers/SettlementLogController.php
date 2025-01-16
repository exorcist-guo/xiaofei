<?php

namespace App\Admin\Controllers;

use App\Model\SettlementLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SettlementLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '结算明细';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SettlementLog());


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
                $filter->equal('member.number',  __('Number'));
                $filter->equal('bonus_settlement_id', __('Bonus settlement id'));
                $filter->equal('related_id', __('Related id'));
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('type', __('Type'))->select(SettlementLog::TYPE_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('bonus_settlement_id', __('Bonus settlement id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('type', __('Type'))->using(SettlementLog::TYPE_MAP);
        $grid->column('amount', __('Amount'))->totalRow();
        $grid->column('balance_after', __('Balance after'));
        $grid->column('related_id', __('Related id'));
        $grid->column('yuan_amount', __('Yuan amount'));
        $grid->column('ratio', __('Ratio'));
        $grid->column('remark', __('Remark'));
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
        $show = new Show(SettlementLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bonus_settlement_id', __('Bonus settlement id'));
        $show->field('member_id', __('Member id'));
        $show->field('type', __('Type'));
        $show->field('amount', __('Amount'));
        $show->field('balance_after', __('Balance after'));
        $show->field('related_id', __('Related id'));
        $show->field('yuan_amount', __('Yuan amount'));
        $show->field('ratio', __('Ratio'));
        $show->field('remark', __('Remark'));
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
        $form = new Form(new SettlementLog());

        $form->number('bonus_settlement_id', __('Bonus settlement id'));
        $form->number('member_id', __('Member id'));
        $form->number('type', __('Type'));
        $form->decimal('amount', __('Amount'));
        $form->decimal('balance_after', __('Balance after'));
        $form->number('related_id', __('Related id'));
        $form->decimal('yuan_amount', __('Yuan amount'));
        $form->text('ratio', __('Ratio'));
        $form->text('remark', __('Remark'));

        return $form;
    }
}
