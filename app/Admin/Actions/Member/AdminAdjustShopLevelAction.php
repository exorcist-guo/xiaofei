<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;

use App\Model\ShopNumber;
use App\ShopLevel;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminAdjustShopLevelAction extends RowAction
{
    public $name = '社区等级';

    public function handle(Model $model, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$model->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }

            $toLevel = $request->input('to_level');
            if($toLevel == $model->level){
                throw new BizException('未变动等级');
            }

            if(!in_array($toLevel, array_keys(ShopLevel::getName()))) {
                throw new BizException('非法的等级');
            }
            if(!$model->shop_level){
                $zuohao = $request->input('zuohao','');
                if(empty($zuohao)){
                    throw new BizException('组号不能为空');
                }
                $shop_nimber = ShopNumber::whereNumber($zuohao)->first();
                if(empty($shop_nimber->id)){
                    throw new BizException('组号不存在');
                }
                if($shop_nimber->member_id){
                    throw new BizException('组号已被占用');
                }


            }


            $result = ChangeOrder::adjustMemberShopLevel($model,$toLevel,$zuohao);
            if($result){
                return $this->response()->success('已提交等待审核')->refresh();
            }else{
                throw new BizException('操作失败');
            }
        }catch(\Exception $e){
            Redis::expire($redis_key,2);
            return $this->response()->error($e->getMessage());
        }

    }

    public function form($user)
    {
        $this->select('to_level', '目标等级')
            ->options(ShopLevel::getName())
            ->default($user->level)
            ->rules('required');
        if(!$user->shop_level){
            $this->text('zuohao',__('Number Z'));
        }

    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('change-level')) {
            return false;
        }

        return true;
    }
}
