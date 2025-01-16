<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Member\AdminDaoruSaveMember;
use App\Admin\Actions\Post\ImportSaveMemberPost;
use App\ChangeOrder;
use App\PostSaveMember;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostSaveMemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '批量修改';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PostSaveMember());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableActions();
        $grid->disableBatchActions();
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportSaveMemberPost());
            $tools->append(new AdminDaoruSaveMember());
        });
        $grid->filter(function (Grid\Filter $filter) {

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('member_id', '账号ID');
                $filter->contains('member.number', '账号');
                $filter->equal('pici', '批次');
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('status', '状态')->select(PostSaveMember::STATUS_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
                $filter->contains('audite.name', '审核员');
            });
        });

        $grid->column('id', __('Id'));
//        $grid->column('member.number', __('Number'));

        $grid->column('status', __('Status'))->using(
            PostSaveMember::STATUS_MAP
        )->label([0=>'default',1=>'danger',2=>'success',3=>'success',4=>'warning']);
        $grid->column('pici', '批次');
        $grid->column('member.number', '账号');
        $grid->column('member.real_name', __('Real name'));
        $grid->column('content', __('Content'))->display(function ($content){
            $view =ChangeOrder::getContentView($content,$this->type);
            if($view){
                return $view;
            }else{
                return  $content;
            }
        });
        $grid->column('operator.name', __('Admin username'));
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
        $show = new Show(PostSaveMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('admin_id', __('Admin id'));
        $show->field('audite_admin_id', __('Audite admin id'));
        $show->field('status', __('Status'));
        $show->field('type', __('Type'));
        $show->field('pici', __('Pici'));
        $show->field('content', __('Content'));
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
        $form = new Form(new PostSaveMember());

        $form->number('member_id', __('Member id'));
        $form->number('admin_id', __('Admin id'));
        $form->number('audite_admin_id', __('Audite admin id'));
        $form->number('status', __('Status'));
        $form->number('type', __('Type'));
        $form->number('pici', __('Pici'));
        $form->text('content', __('Content'));
        $form->text('error', __('Error'));

        return $form;
    }
}
