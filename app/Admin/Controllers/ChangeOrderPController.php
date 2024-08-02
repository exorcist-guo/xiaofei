<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Member\CheckChangeOrder;
use App\ChangeOrder;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ChangeOrderPController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '营业额变动申请';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ChangeOrder());

        $grid->model()->where('type',4)->orderByDesc('id');
        $grid->disableCreateButton();

//        $grid->export(function ($export) {
//
//            $export->filename($this->title.date('Y-m-d').'.csv');
//
//        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();

            if ($this->row->status == 0 && Admin::user()->can('check_save-member') ) {
                $actions->add(new CheckChangeOrder());
            }

        });
        $grid->batchActions(function(Grid\Tools\BatchActions $batchActions){
            $batchActions->disableDelete();
            if (Admin::user()->can('disable-member')) {
//                $batchActions->add(new AdminBatchRemoveMembersToBlackList());
            }

        });

        $grid->filter(function (Grid\Filter $filter) {

            $filter->disableIdFilter();

            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('member_id', '账号ID');
                $filter->contains('member.number', '账号');
                $filter->contains('operator.name', '操作员');
            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('status', '状态')->select(ChangeOrder::STATUS_MAP);
                $filter->between('created_at',__('Created at'))->datetime();
                $filter->contains('audite.name', '审核员');
            });
        });


        $grid->column('id', __('Id'));
        $grid->column('member.number', __('Number'));

        $grid->column('status', __('Status'))->using(
            ChangeOrder::STATUS_MAP
        )->label([0=>'default',1=>'danger',2=>'success',3=>'success',4=>'warning']);

        $grid->column('content', __('Content'))->display(function ($content){
            $view =ChangeOrder::getContentView($content,$this->type);
            if($view){
                return $view;
            }else{
                return  $content;
            }
        });
        $grid->column('operator.username', __('Admin username'));
        $grid->column('audite.username', __('Audite username'));
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
        $show = new Show(ChangeOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('admin_id', __('Admin id'));
        $show->field('audite_admin_id', __('Audite admin id'));
        $show->field('type', __('Type'));
        $show->field('status', __('Status'));
        $show->field('content', __('Content'));
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
        $form = new Form(new ChangeOrder());



        return $form;
    }
}
