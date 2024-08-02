<?php

namespace App\Admin\Controllers;

use App\Shop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());
//        $grid->model()->orderByDesc('id');
        $grid->disableBatchActions();
//        $grid->expandFilter();
        $grid->disableFilter();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Shopname'));
        $grid->column('cookie', __('Cookie'))->width(200)->limit(15)->ucfirst();

//            ->display(function ($cookie){
//            return substr($cookie,0,5);
//        });
        $grid->column('status', __('Status'))->using(
            [0=>'异常',1=>'正常']
        )->label([0=>'danger',1=>'success']);
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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Shopname'));
        $show->field('cookie', __('Cookie'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->panel()->tools(function ($tools) {
//            $tools->disableEdit();
            $tools->disableDelete();
//            $tools->disableList();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shop());

        $form->text('name', __('Shopname'));
        $form->textarea('cookie', __('Cookie'));

        $form->tools(function (Form\Tools $tools) {

            // 去掉`列表`按钮
//            $tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
//            $tools->disableView();


        });

        return $form;
    }
}
