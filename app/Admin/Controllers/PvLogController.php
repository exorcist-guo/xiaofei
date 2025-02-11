<?php

namespace App\Admin\Controllers;

use App\Member;
use App\PvLogs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PvLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '营业额记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PvLogs());

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
                $filter->equal('action', '动作')->select(PvLogs::STATUS_MAP);

                $filter->where(function ($query) {

                    $parent = Member::whereNumber($this->input)->first();
                    if (!$parent) {
                        admin_error('用户不存在', '用户不存在');
                    } else {

                        $ids = Member::where('shop_member_id',$parent->id)->pluck('id');

                        $query->whereIn('member_id',$ids);
                    }
                }, __('Shop number'), 'shop_number')->placeholder(__('Shop number'));
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('shop_number', __('Shop number'))->display(function (){
            return isset($this->member->shop->number)?$this->member->shop->number:'';
        });
        $grid->column('zu_real_name', __('Shop real name'))->display(function (){
            return isset($this->member->shop->real_name)?$this->member->shop->real_name:'';
        });



        $grid->column('action', __('Action'))->using(PvLogs::STATUS_MAP);
        $grid->column('amount', __('Amount'))->totalRow();
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
        $show = new Show(PvLogs::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('action', __('Action'));
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
        $form = new Form(new PvLogs());

        $form->number('member_id', __('Member id'));
        $form->number('action', __('Action'));
        $form->decimal('amount', __('Amount'));
        $form->decimal('balance_before', __('Balance before'));
        $form->decimal('balance_after', __('Balance after'));
        $form->text('remark', __('Remark'));
        $form->number('related_id', __('Related id'));

        return $form;
    }
}
