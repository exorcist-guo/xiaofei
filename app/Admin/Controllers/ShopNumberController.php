<?php

namespace App\Admin\Controllers;

use App\Model\ShopNumber;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class ShopNumberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '组号列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopNumber());
        $grid->disableBatchActions();
//        $grid->model();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
//            $actions->disableEdit();
            $actions->disableView();



        });

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('number', __('Number Z'));
//        $grid->column('status', __('Status'));
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
        $show = new Show(ShopNumber::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('number', __('Number Z'));
//        $show->field('status', __('Status'));
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
        $form = new Form(new ShopNumber());

        $form->saving(function (Form $form) {
            //保存前回掉

            //获取提交数据
            $data = \request()->input();

            $message = '';
            if(!empty($data['number'])){
                if(strlen($data['number']) != 4){
                    $message = '组号必须是4位';

                }

                $a = ShopNumber::whereNumber($data['number'])->first();
                if($a){
                    $message = '组号不能重复';

                }
            }
            if($message){
                $error = new MessageBag([
                    'title'   => '错误',
                    'message' => $message,
                ]);
                return back()->with(compact('error'));
            }


        });




//        $form->number('member_id', __('Member id'));
        $form->number('number', __('Number Z'));
//        $form->number('status', __('Status'));

        return $form;
    }
}
