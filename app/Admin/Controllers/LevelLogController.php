<?php

namespace App\Admin\Controllers;

use App\Model\LevelLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LevelLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '等级记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LevelLog());
        $grid->model()->where('type',1)->orderByDesc('id');
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

            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('action', '类型')->select(LevelLog::ACTION_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('action', __('Action'))->using(LevelLog::ACTION_MAP);
//        $grid->column('type', __('Type'));
        $grid->column('level_before', __('Level before'));
        $grid->column('level_after', __('Level after'));
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
        $show = new Show(LevelLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('action', __('Action'));
        $show->field('type', __('Type'));
        $show->field('level_before', __('Level before'));
        $show->field('level_after', __('Level after'));
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
        $form = new Form(new LevelLog());

//        $form->number('member_id', __('Member id'));
//        $form->number('action', __('Action'));
//        $form->number('type', __('Type'));
//        $form->decimal('level_before', __('Level before'));
//        $form->decimal('level_after', __('Level after'));

        return $form;
    }
}
