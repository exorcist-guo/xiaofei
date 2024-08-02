<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Member\AdminDaoruMember;
use App\Admin\Actions\Post\ImportMemberPost;
use App\Jobs\PostMemberJob;
use App\PostMember;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostMemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员导入';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PostMember());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportMemberPost());
            $tools->append(new AdminDaoruMember());
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
//            $actions->disableEdit();
//            $actions->disableView();

        });
        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('number', '账号');
                $filter->contains('id_number', '身份证号');
                $filter->equal('pici', '批次');
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('status', '状态')->select(PostMember::STATUS_MAP);
                $filter->contains('pid_id_number', '上级身份证号');
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });


        $grid->column('id', __('Id'));
        $grid->column('status', __('Status'))->using(
            PostMember::STATUS_MAP
        );
        $grid->column('pici', __('Pici'));
        $grid->column('mobile', __('Mobile'));
        $grid->column('pid_id_number', __('Pid id number'));
        $grid->column('number', __('Number'));
        $grid->column('real_name', __('Real name'));
        $grid->column('id_number', __('Id number'));
        $grid->column('error', __('Error'));
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
        $show = new Show(PostMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('pici', __('Pici'));
        $show->field('mobile', __('Mobile'));
        $show->field('pid_id_number', __('Pid id number'));
        $show->field('number', __('Number'));
        $show->field('real_name', __('Real name'));
        $show->field('id_number', __('Id number'));
        $show->field('error', __('Error'));
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
        $form = new Form(new PostMember());

//        $form->number('status', __('Status'));
//        $form->number('pici', __('Pici'));
        $form->text('mobile', __('Mobile'));
        $form->text('pid_id_number', __('Pid id number'));
//        $form->text('number', __('Number'));
        $form->text('real_name', __('Real name'));
        $form->text('id_number', __('Id number'));
//        $form->text('error', __('Error'));
        $form->saved(function (Form $form) {
            $id = $form->model()->id;
            $data['id'] = $id;
            PostMemberJob::dispatch($data);
        });

        return $form;
    }
}
