<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('levels', LevelController::class);
    $router->resource('shop-levels', ShopLevelController::class);
    $router->resource('members', MemberController::class); //会员列表
    $router->resource('member-shop', MemberShopController::class); //社区列表
    $router->resource('withdrawals', WithdrawalController::class);
    $router->resource('withdrawal-ds', WithdrawalDsController::class);
    $router->resource('transfers', TransferController::class);
    $router->resource('push-orders', PushOrderController::class);
    $router->resource('pv-logs', PvLogController::class);
    $router->resource('integral-logs', IntegralLogController::class);
    $router->resource('push-integrals', PushIntegralController::class);
    $router->resource('login-logs', LoginLogController::class);
    $router->any('add-member', AdminAddMember::class);  //添加会员
    $router->resource('proclamations', ProclamationController::class); //公告
    $router->resource('wallets', WalletController::class); //综合钱包

    $router->resource('dikouquan-logs', DikouquanLogController::class); //抵扣券记录

    $router->resource('change-orders-m', ChangeOrderMController::class); //会员信息修改列表
    $router->resource('change-orders-s', ChangeOrderSController::class); //会员状态变更申请
    $router->resource('change-orders-t', ChangeOrderTController::class); //推荐人改变申请
    $router->resource('change-orders-i', ChangeOrderIController::class); //积分变动申请
    $router->resource('change-orders-p', ChangeOrderPController::class); //营业额变动申请
    $router->resource('change-orders-j', ChangeOrderJController::class); //激活设置申请
    $router->resource('change-orders-pt', ChangeOrderPtController::class); //特殊已结算营业额变动申请
    $router->resource('change-orders-d', ChangeOrderDController::class); //消费券变动申请
    $router->resource('change-orders-l', ChangeOrderLController::class); //会员等级变动申请
    $router->resource('change-orders-shop', ChangeOrderShopController::class); //社区等级修改
    $router->resource('change-orders-tr', ChangeOrderTrController::class); //消费券转账申请

    //导入
    $router->resource('post-members', PostMemberController::class);  //会员导入
    $router->resource('post-save-members', PostSaveMemberController::class); //导入批量修改


    $router->resource('bonus-settlements', BonusSettlementController::class); //奖金结算
    $router->resource('settlement-members', SettlementMemberController::class); //结算汇总
    $router->resource('settlement-logs', SettlementLogController::class); //结算明细




    $router->resource('levellogs', LevelLogController::class); //等级记录
    $router->resource('shoplevellogs', ShopLevelLogController::class); //社区等级记录
    $router->resource('post-templates', PostTemplateController::class);//导入模版下载
    $router->resource('shop-numbers', ShopNumberController::class); //组号列表

    $router->resource('member-examines', MemberExamineController::class); //待审核会员
    $router->resource('messages', MessageController::class); //留言管理
    $router->resource('member-tree', MemberTreeController::class); //用户树状图
    $router->any('member-treev2', 'MemberTreeV2Controller@index')->name('index'); //新版树状图
    $router->resource('treev2/get', MemberTreeV2Controller::class); //新版树状图
    $router->any('treev2/get', 'MemberTreeV2Controller@getMemberData')->name('getMemberData');

    $router->resource('pv-orders', PvOrderController::class); //营业额订单


//php artisan admin:make PostMemberController --model=App\PostMember  --title=会员导入
});
