<?php

namespace App\Admin\Controllers;

use App\LoginLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LoginLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户登录日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoginLog());
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
                $filter->contains('member.mobile', '邮箱');
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->contains('member.number', '账号');
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('账号'));
        $grid->column('member.real_name', __('Real name'));

        $grid->column('ip', __('Ip'));
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
        $show = new Show(LoginLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('ip', __('Ip'));
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
        $form = new Form(new LoginLog());

//        $form->number('member_id', __('Member id'));
//        $form->ip('ip', __('Ip'));

        return $form;
    }
}
