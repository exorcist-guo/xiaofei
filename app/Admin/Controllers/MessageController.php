<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\ReplyMessageAction;
use App\Model\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '留言列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message());

        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->expandFilter();
//        $grid->disableActions();
        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('member_id', '账号ID');
                $filter->equal('mobile', '联系手机');
                $filter->equal('name', __('Name'));


            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('status', __('Status'))->select(Message::STATUS_MAP);
                $filter->equal('type', __('Type'))->select(Message::TYPE_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
            });
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();

            $actions->add(new ReplyMessageAction());

        });

        $grid->column('id', __('Id'));
//        $grid->column('member_id', __('Member id'));
        $grid->column('member.number', __('Number'));
        $grid->column('type', __('Type'))->using(Message::TYPE_MAP);
//        $grid->column('admin_id', __('Admin id'));
        $grid->column('operator.username', __('Reply username'));
        $grid->column('mobile', '联系手机');
        $grid->column('name', __('Name'));
        $grid->column('status', __('Status'))->using(Message::STATUS_MAP);
        $grid->column('question', __('Question'));
        $grid->column('reply', __('Reply'));
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
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('type', __('Type'));
        $show->field('admin_id', __('Admin id'));
        $show->field('mobile', __('Mobile'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
        $show->field('question', __('Question'));
        $show->field('reply', __('Reply'));
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
        $form = new Form(new Message());

        $form->number('member_id', __('Member id'));
        $form->number('type', __('Type'));
        $form->number('admin_id', __('Admin id'));
        $form->mobile('mobile', __('Mobile'));
        $form->text('name', __('Name'));
        $form->number('status', __('Status'));
        $form->textarea('question', __('Question'));
        $form->text('reply', __('Reply'));

        return $form;
    }
}
