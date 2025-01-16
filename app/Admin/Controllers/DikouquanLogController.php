<?php

namespace App\Admin\Controllers;

use App\Model\DikouquanLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DikouquanLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '抵扣券记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DikouquanLog());

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
                $filter->equal('related_id', __('Related id'));
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('type',  '消费券类型')->select(DikouquanLog::TYPE_MAP);
                $filter->equal('action', '动作')->select(DikouquanLog::STATUS_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));
        $grid->column('action', __('Action'))->using(DikouquanLog::STATUS_MAP);
        $grid->column('type', '消费券类型')->using(DikouquanLog::TYPE_MAP);
        $grid->column('amount', __('Amount'));
        $grid->column('balance_before', __('Balance before'));
        $grid->column('balance_after', __('Balance after'));
        $grid->column('remark', __('Remark'));
        $grid->column('related_id', __('Related id'));
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
        $show = new Show(DikouquanLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('action', __('Action'));
        $show->field('type', __('Type'));
        $show->field('amount', __('Amount'));
        $show->field('balance_before', __('Balance before'));
        $show->field('balance_after', __('Balance after'));
        $show->field('remark', __('Remark'));
        $show->field('related_id', __('Related id'));
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
        $form = new Form(new DikouquanLog());

        $form->number('member_id', __('Member id'));
        $form->number('action', __('Action'));
        $form->number('type', __('Type'));
        $form->decimal('amount', __('Amount'));
        $form->decimal('balance_before', __('Balance before'));
        $form->decimal('balance_after', __('Balance after'));
        $form->text('remark', __('Remark'));
        $form->number('related_id', __('Related id'));

        return $form;
    }
}
