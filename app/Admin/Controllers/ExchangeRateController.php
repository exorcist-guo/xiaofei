<?php

namespace App\Admin\Controllers;

use App\Exceptions\BizException;
use App\IntegralLogs;
use App\Model\ExchangeRate;
use App\Withdrawal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExchangeRateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '汇率设置';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExchangeRate());
        $grid->model()->orderByDesc('id');
//        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->expandFilter();
        $grid->disableActions();
        $grid->filter(function(Grid\Filter $filter){

            $filter->disableIdFilter();

            $filter->equal('rate', __('Rate'));
        });

        $grid->column('id', __('Id'));
        $grid->column('rate', __('Rate'));
        $grid->column('status', __('Status'))->using(ExchangeRate::STATUS_MAP);
        $grid->column('admin_id', __('Admin id'));
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
        $show = new Show(ExchangeRate::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('rate', __('Rate'));
        $show->field('status', __('Status'));
        $show->field('admin_id', __('Admin id'));
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
        $form = new Form(new ExchangeRate());

        $form->saving(function (Form $form) {
            //保存前回掉

            //获取提交数据
            $rate = \request()->input('rate',0);
            if($rate == 0){
                throw new BizException('汇率不能为0');
            }

            try{
                ExchangeRate::whereStatus(0)->update(['status'=>1]);
            }catch (\Exception $e){

                $error = new MessageBag([
                    'title'   => '错误',
                    'message' => $e->getMessage(),
                ]);

                return back()->with(compact('error'));
            }

        });

        $form->text('rate', __('Rate'));
        //保存后回调
        $form->saved(function (Form $form) {
            $rate = ExchangeRate::whereStatus(0)->orderByDesc('id')->value('rate');
            Withdrawal::whereStatus(0)->update(['rate'=>$rate]);
        });

//        $form->switch('status', __('Status'));
//        $form->number('admin_id', __('Admin id'));

        return $form;
    }
}
