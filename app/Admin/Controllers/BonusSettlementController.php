<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\AdminSubmitBonusSettlement;
use App\Admin\Actions\Member\AdminDaoruMember;
use App\Admin\Actions\Post\ImportMemberPost;
use App\Model\BonusSettlement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BonusSettlementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '奖金结算';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BonusSettlement());
        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new AdminSubmitBonusSettlement());
        });

        $grid->column('id', __('Id'));
        $grid->column('status', __('Status'));
        $grid->column('operator.username', __('Admin username'));
        $grid->column('start_time', __('Start time'));
        $grid->column('end_time', __('End time'));
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
        $show = new Show(BonusSettlement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('admin_id', __('Admin id'));
        $show->field('start_time', __('Start time'));
        $show->field('end_time', __('End time'));
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
        $form = new Form(new BonusSettlement());

//        $form->number('status', __('Status'));
//        $form->number('admin_id', __('Admin id'));
//        $form->number('start_time', __('Start time'));
//        $form->number('end_time', __('End time'));

        return $form;
    }
}
