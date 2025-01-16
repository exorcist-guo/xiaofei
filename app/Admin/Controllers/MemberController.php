<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Member\AdminAddMemberAction;
use App\Admin\Actions\Member\AdminAdjustMemberAssetAction;
use App\Admin\Actions\Member\AdminAdjustMemberLevelAction;
use App\Admin\Actions\Member\AdminAdjustMemberStatusAction;
use App\Admin\Actions\Member\AdminAdjustShopLevelAction;
use App\Admin\Actions\Member\AdminDikouquanTransfer;
use App\Admin\Actions\Member\AdminLoginMemberAction;
use App\Admin\Actions\Member\AdminSaveMemberAction;
use App\Admin\Actions\Member\AdminSavePidAction;
use App\Admin\Actions\MemberIsDisabledAction;
use App\Admin\Actions\Post\ImportMemberPost;
use App\Auth\JwtUserProvider;
use App\Level;
use App\Member;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员列表';

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
        $grid->fixColumns(3, -1);

        $grid->actions(function (Grid\Displayers\DropdownActions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();

            if (Admin::user()->can('change-level')) {
                $actions->add(new AdminAdjustMemberLevelAction());
            }

            if (Admin::user()->can('disable-member')) {
                $actions->add(new AdminAdjustMemberStatusAction());
            }
//            if (Admin::user()->can('add-member')) {
//                $actions->add(new AdminAddMemberAction());
//            }
            if (Admin::user()->can('save-member')) {
                $actions->add(new AdminSaveMemberAction());
            }

            if (Admin::user()->can('save-asset')) {
                $actions->add(new AdminAdjustMemberAssetAction());
            }

            if (Admin::user()->can('save-pid')) {
                $actions->add(new AdminSavePidAction());
            }

            if (Admin::user()->can('change-shop-level')) {
                $actions->add(new AdminAdjustShopLevelAction());
            }

            if (Admin::user()->can('dikouquan-transfer')) {
                $actions->add(new AdminDikouquanTransfer());
            }

            if (Admin::user()->can('save-member')) {
                $actions->add(new AdminLoginMemberAction());
            }
        });

        $grid->batchActions(function(Grid\Tools\BatchActions $batchActions){
            $batchActions->disableDelete();
            if (Admin::user()->can('disable-member')) {
//                $batchActions->add(new AdminBatchRemoveMembersToBlackList());
            }

        });

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->append(new ImportMemberPost());
//        });
        $grid->filter(function (Grid\Filter $filter) {

            $filter->column(1 / 2, function (Grid\Filter $filter) {
                $filter->contains('mobile', '注册邮箱');
                $filter->equal('pid', 'PID');
                $filter->equal('number',  __('Number'));
                $filter->between('created_at', __('Created at'))->datetime();
                $filter->equal('nation',  __('Nation'))->select(Member::getNations());
                $filter->where(function ($query) {
                    $parent = Member::find($this->input);
                    if (!$parent) {
                        admin_error('用户不存在', '节点不存在');
                    } else {
                        if($parent->path){
                            $path = $parent->path . $parent->id.'/';
                        }else{
                            $path = '/'.$parent->id.'/';
                        }
                        $query->where('id', $this->input)
                            ->orWhereIn('id', explode('/', $parent->path))
                            ->orWhere('path', 'like', "{$path}%");
                    }
                }, __('Team'), '_team')->placeholder('输入用户ID');

//                $filter->contains('secretInfo.contract_mobile', '联系电话');
            });
            $filter->column(1 / 2, function (Grid\Filter $filter) {
                $filter->equal('level', __('Level'))->select(Level::getName());

                $filter->equal('is_disabled', '状态')->select(Member::IS_DISABLED_MAP);
                $filter->contains('real_name',__('Real name'));
                $filter->contains('id_number',__('Id number'));

                $filter->equal('spread.number',__('Spread number'));
                $filter->equal('shop.number',__('Shop number'));


            });
        });



        $grid->column('id', __('Id'))->sortable();
        $grid->column('number', __('Number'));
        $grid->column('real_name', __('Real name'));
        $grid->column('pid', __('Pid'))->hide();

        $grid->column('level', __('Level'))->using(Level::getName())
            ->label([
                0 => 'default',
                1 => 'info',
                2 => 'success',
                3 => 'warning',
                4 => 'danger',
            ]);
        $grid->column('shop_level', __('Shop level'));
        $grid->column('mobile', __('Mobile'));



        $grid->column('spread.number', __('Spread number'));
        $grid->column('spread.real_name', __('Spread real name'));

        if(intval(request('_team'))>0) {
            /** @var Member $current */
            $current = Member::find(request('_team'));
            $grid->column('teamDeep', '团队深度')->display(function() use ($current){
                $deep = $this->deep - $current->deep;

                if($deep == 0) {
                    $v = '当前用户';
                }
                else if($deep>0) {
                    $v = sprintf('伞下%d级', $deep);
                }
                else {
                    $v = sprintf('上%d级', abs($deep));
                }

                return $v;
            });
        } else {
            $grid->column('deep', __('Deep'))->sortable();

        }


        $grid->column('nation', __('Nation'))->using(Member::getNations());
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
        $grid->column('divvy_pv', __('Divvy Pv'))->hide();

        $grid->column('dikouquan', __('Dikouquan'))->sortable();
        $grid->column('dikouquan_k', __('Dikouquan_k'))->sortable();
//        $grid->column('certificate_type', __('Certificate Type'))->using(Member::getNtlw());

        $grid->column('id_number', __('Id number'));
        $grid->column('zuhao.number', __('Number Z'));
        $grid->column('shop_member_id', __('Shop member id'));
        $grid->column('shop.number', __('Shop number'));
        $grid->column('shop.real_name', __('Shop real name'));

//        $grid->column('last_ip', __('Last ip'));
        $grid->column('last_login', __('Last login'))->hide();
        $grid->column('is_disabled', __('Is disabled'))->using(
            Member::IS_DISABLED_MAP
        )->label([0=>'success',1=>'danger']);
//        $grid->column('disabled_at', __('Disabled at'));

//        $grid->column('is_set_transaction_password', __('Is set transaction password'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->column('aaaa', '登录')->display(function($value){
            $token = JwtUserProvider::getToken($this->id);
            return sprintf("<a href='%s/#/pages/login/login?zhitonglog=%s' target='_blank'> 登录</a>",config('app.h5url'),$token);
        });


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
