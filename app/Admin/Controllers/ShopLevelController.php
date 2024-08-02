<?php

namespace App\Admin\Controllers;

use App\ShopLevel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopLevelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '社区等级';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopLevel());
        $grid->disableFilter();
        $grid->disableBatchActions();
        $grid->disableExport();

        $grid->column('id', __('Id'));
        $grid->column('real_name', __('Level name'));
        $grid->column('pv', '个人业绩');
        $grid->column('bazaar_pv','市场业绩');

//        $grid->column('tj_ratio', __('Tj ratio'));
        $grid->column('jc_ratio', '服务费');
//        $grid->column('jf_ratio', __('Jf ratio'));
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
        $show = new Show(ShopLevel::findOrFail($id));



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
        $form = new Form(new ShopLevel());

        $form->text('real_name', __('Level name'));
        $form->decimal('pv', '个人业绩')->default(0.00);
        $form->decimal('bazaar_pv', '市场业绩')->default(0.00);
//        $form->text('tj_ratio', __('Tj ratio'));
        $form->text('jc_ratio', '服务费');
//        $form->text('jf_ratio', __('Jf ratio'));

        return $form;
    }
}
