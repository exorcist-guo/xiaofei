<?php

namespace App\Admin\Controllers;

use App\Level;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LevelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员等级';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Level());

        $grid->disableFilter();
        $grid->disableBatchActions();
        $grid->disableExport();
        $grid->column('id', __('Id'));
        $grid->column('real_name', __('Level name'));
        $grid->column('pv', __('Pv'));
        $grid->column('tj_ratio', __('Tj ratio'));
        $grid->column('jc_ratio', __('Jc ratio'));
        $grid->column('jf_ratio', __('Jf ratio'));
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
        $show = new Show(Level::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('real_name', __('Level name'));
        $show->field('pv', __('Pv'));
        $show->field('tj_ratio', __('Tj ratio'));
        $show->field('jc_ratio', __('Jc ratio'));
        $show->field('jf_ratio', __('Jf ratio'));
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
        $form = new Form(new Level());

        $form->text('real_name', __('Level name'));
        $form->decimal('pv', __('Pv'))->default(0.00);
        $form->text('tj_ratio', __('Tj ratio'));
        $form->text('jc_ratio', __('Jc ratio'));
        $form->text('jf_ratio', __('Jf ratio'));

        return $form;
    }
}
