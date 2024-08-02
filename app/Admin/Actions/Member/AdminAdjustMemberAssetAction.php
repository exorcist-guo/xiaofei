<?php

namespace App\Admin\Actions\Member;

use App\ChangeOrder;
use App\Exceptions\BizException;
use App\Member;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminAdjustMemberAssetAction extends RowAction
{
    public $name = '修改资产';

    public function handle(Member $user, Request $request)
    {
        try{
            $redis_key = 'admin_member_adjust_limit'.$user->id;
            if(!Redis::set($redis_key, 1, 'ex', 3, 'nx')) {
                throw new BizException('操作太频繁');
            }
            $asset_type = $request->input('asset_type',0);
            $amount = $request->input('amount',0);
            $asset_types = ChangeOrder::ASSET_TYPE;
            if(!isset($asset_types[$asset_type])){
                throw new BizException('资产类型有误');
            }
            if($asset_type == 4){
                if($amount < 0){
                    throw new BizException('不能减少营业额');
                }
            }

            if(empty($amount)){
                throw new BizException('改变资产不能为0');
            }
            $result = ChangeOrder::saveAsset($user,$asset_type,$amount);

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

    public function form(Member $model)
    {
        $this->radio('asset_type','资产类型')->options(ChangeOrder::ASSET_TYPE)->rules('required');

        $this->text('amount','数量')
            ->rules('required')
            ->help('输入正数增加，输入负数减少')
        ;

    }

    public function authorize($user, $model)
    {
        if(!Admin::user()->can('save-asset')) {
            return false;
        }

        return true;
    }
}
