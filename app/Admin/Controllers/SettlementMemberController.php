<?php

namespace App\Admin\Controllers;

use App\Model\SettlementMember;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SettlementMemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '结算汇总';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SettlementMember());

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

            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('shop_member_id', '所属社群ID');
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('bonus_settlement_id', __('Bonus settlement id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('shop_member_id', __('Shop member id'));
        $grid->column('status', __('Status'));

        $grid->column('jh', __('Jh'));
        $grid->column('fl', __('Fl'));
        $grid->column('jc', __('Jc'));
        $grid->column('tj', __('Tj'));
        $grid->column('fw', __('Fw'));
        $grid->column('bt', __('Bt'));
        $grid->column('cx', __('Cx'));
        $grid->column('jl_all', __('Jl All'))->display(function(){
            $js_all =  $this->fl + $this->jc + $this->tj + $this->fw + $this->bt + $this->cx;
            return $js_all;
        });
        $grid->column('yj', __('Yj'));
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
        $show = new Show(SettlementMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bonus_settlement_id', __('Bonus settlement id'));
        $show->field('member_id', __('Member id'));
        $show->field('shop_member_id', __('Shop member id'));
        $show->field('status', __('Status'));
        $show->field('jh', __('Jh'));
        $show->field('jc', __('Jc'));
        $show->field('tj', __('Tj'));
        $show->field('fw', __('Fw'));
        $show->field('bt', __('Bt'));
        $show->field('cx', __('Cx'));
        $show->field('yj', __('Yj'));
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
        $form = new Form(new SettlementMember());

        $form->number('bonus_settlement_id', __('Bonus settlement id'));
        $form->number('member_id', __('Member id'));
        $form->number('shop_member_id', __('Shop member id'));
        $form->number('status', __('Status'));
        $form->decimal('jh', __('Jh'));
        $form->decimal('jc', __('Jc'));
        $form->decimal('tj', __('Tj'));
        $form->decimal('fw', __('Fw'));
        $form->decimal('bt', __('Bt'));
        $form->decimal('cx', __('Cx'));
        $form->decimal('yj', __('Yj'));

        return $form;
    }
}
