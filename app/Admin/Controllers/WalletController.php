<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Member\AdminAddMemberAction;
use App\Admin\Actions\Member\AdminAdjustMemberAssetAction;
use App\Admin\Actions\Member\AdminAdjustMemberLevelAction;
use App\Admin\Actions\Member\AdminAdjustMemberStatusAction;
use App\Admin\Actions\Member\AdminAdjustShopLevelAction;
use App\Admin\Actions\Member\AdminDikouquanTransfer;
use App\Admin\Actions\Member\AdminJiHuo;
use App\Admin\Actions\Member\AdminLoginMemberAction;
use App\Admin\Actions\Member\AdminSaveMemberAction;
use App\Admin\Actions\Member\AdminSavePidAction;
use App\Admin\Actions\MemberIsDisabledAction;
use App\Admin\Actions\Post\ImportMemberPost;
use App\Auth\JwtUserProvider;
use App\Level;
use App\Member;
use App\ShopLevel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WalletController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '综合钱包';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member());
        $grid->model()->orderByDesc('id');
        $grid->disableCreateButton();
        $grid->expandFilter();
        $grid->enableHotKeys();
        $grid->disableActions();
        $grid->disableBatchActions();

//        $grid->actions(function (Grid\Displayers\DropdownActions $actions) {
//            $actions->disableDelete();
//            $actions->disableEdit();
//            $actions->disableView();
//
//        });



        $grid->filter(function (Grid\Filter $filter) {

            $filter->column(1 / 2, function (Grid\Filter $filter) {


                $filter->equal('number',  __('Number'));
                $filter->between('created_at', __('Created at'))->datetime();

            });
            $filter->column(1 / 2, function (Grid\Filter $filter) {
//                $filter->scope('wallet_type', '钱包类型');
                $filter->between('integral',__('Integral'));
                $filter->between('pv',__('Pv'));
                $filter->between('dikouquan',__('Dikouquan'));
                $filter->between('dikouquan_k',__('Dikouquan_k'));




            });
        });



        $grid->column('id', __('Id'))->sortable();
        $grid->column('number', __('Number'));
        $grid->column('real_name', __('Real name'));



        $grid->column('integral', __('Integral'))->sortable();
        $grid->column('all_integral', __('All integral'))->sortable();
        $grid->column('pv', __('Pv'))->sortable();
        $grid->column('divvy_pv_t', __('Divvy Pv T'));
        $grid->column('pv_leiji', '累计业绩')->display(function() {
            if($this->path){
                $path = $this->path . $this->id.'/';
            }else{
                $path = '/'.$this->id.'/';
            }
            $all_divvy_pv = Member::where('path', 'like', "{$path}%")->sum('divvy_pv');
            $all_divvy_pv = $all_divvy_pv + $this->divvy_pv + $this->divvy_pv_t;
            return $all_divvy_pv;
        });
        $grid->column('divvy_pv', __('Divvy Pv'));

        $grid->column('dikouquan', __('Dikouquan'))->sortable();
        $grid->column('dikouquan_k', __('Dikouquan_k'))->sortable();

        $grid->column('created_at', __('Created at'));



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
        $show = new Show(Member::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pid', __('Pid'));
        $show->field('level', __('Level'));
        $show->field('shop_level', __('Shop level'));
        $show->field('mobile', __('Mobile'));
        $show->field('number', __('Number'));
        $show->field('integral', __('Integral'));
        $show->field('all_integral', __('All integral'));
        $show->field('pv', __('Pv'));
        $show->field('avatar', __('Avatar'));
        $show->field('real_name', __('Real name'));
        $show->field('id_number', __('Id number'));
        $show->field('password', __('Password'));
        $show->field('last_ip', __('Last ip'));
        $show->field('last_login', __('Last login'));
        $show->field('is_disabled', __('Is disabled'));
        $show->field('disabled_at', __('Disabled at'));
        $show->field('transaction_password', __('Transaction password'));
        $show->field('is_set_transaction_password', __('Is set transaction password'));
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
        $form = new Form(new Member());

//        $form->number('pid', __('Pid'));
//        $form->number('level', __('Level'));
//        $form->number('shop_level', __('Shop level'));
        $form->mobile('mobile', __('Mobile'))->disable();
        $form->text('number', __('Number'))->disable();
//        $form->decimal('integral', __('Integral'))->default(0.00);
//        $form->decimal('all_integral', __('All integral'))->default(0.00);
//        $form->decimal('pv', __('Pv'))->default(0.00);
//        $form->image('avatar', __('Avatar'));
        $form->text('real_name', __('Real name'));
        $form->text('id_number', __('Id number'));
//        $form->password('password1', __('Password'));
//        $form->text('last_ip', __('Last ip'));
//        $form->datetime('last_login', __('Last login'))->default(date('Y-m-d H:i:s'));
//        $form->number('is_disabled', __('Is disabled'));
//        $form->datetime('disabled_at', __('Disabled at'))->default(date('Y-m-d H:i:s'));
//        $form->password('transaction_password1', __('Transaction password'));
//        $form->number('is_set_transaction_password', __('Is set transaction password'));
//        $form->ignore(['mobile', 'number']);

        return $form;
    }
}
