<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Member\CheckChangeOrder;
use App\Admin\Actions\Member\CheckMember;
use App\Member;
use App\Model\MemberExamine;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberExamineController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '待审核会员';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MemberExamine());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();

            if ($this->row->is_disabled == 8 || $this->row->is_disabled == 7 ) {
                $actions->add(new CheckMember());
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
                $filter->contains('number', '账号');
                $filter->contains('audite.name', '审核员');

            });
            $filter->column(1/2, function(Grid\Filter $filter){
                $filter->equal('is_disabled', '状态')->select(MemberExamine::IS_DISABLED_MAP);
                $filter->between('created_at',__('Created at'))->datetime();

            });
        });

        $grid->column('id', __('Id'));
        $grid->column('is_disabled', __('Is disabled'))->using(
            MemberExamine::IS_DISABLED_MAP
        )->label([7=>'default',8=>'danger',6=>'success']);
        $grid->column('member_id', __('Member id'));
        $grid->column('number', __('Number'));
        $grid->column('real_name', __('Real name'));
        $grid->column('mobile', __('Mobile'));

        $grid->column('id_number', __('Id number'));
        $grid->column('nation', __('Nation'))->using(Member::getNations());
        $grid->column('certificate_type', __('Certificate type'))->using(Member::getNtlw());
        $grid->column('audite.name', __('Audite username'));
        $grid->column('msg', __('Msg'));
        $grid->column('certificate_image', __('Certificate Image'))
        ->display(function ($pictures) {
        // $orderimage=$pictures;
        if(!empty($pictures)){
            $orderimage=explode(',',$pictures);
            return $orderimage;
        }
        return '';

    })->lightbox(['width' => 100]);
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
        $show = new Show(MemberExamine::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('is_disabled', __('Is disabled'));
        $show->field('member_id', __('Member id'));
        $show->field('number', __('Number'));
        $show->field('mobile', __('Mobile'));
        $show->field('real_name', __('Real name'));
        $show->field('id_number', __('Id number'));
        $show->field('nation', __('Nation'));
        $show->field('certificate_type', __('Certificate type'));
        $show->field('msg', __('Msg'));
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
        $form = new Form(new MemberExamine());

        $form->number('is_disabled', __('Is disabled'));
        $form->number('member_id', __('Member id'));
        $form->text('number', __('Number'));
        $form->mobile('mobile', __('Mobile'));
        $form->text('real_name', __('Real name'));
        $form->text('id_number', __('Id number'));
        $form->number('nation', __('Nation'));
        $form->text('certificate_type', __('Certificate type'));
        $form->text('msg', __('Msg'));

        return $form;
    }
}
