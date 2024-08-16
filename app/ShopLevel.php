<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

/**
 * App\ShopLevel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $real_name 名称
 * @property float $pv 营业额
 * @property string $tj_ratio 推荐奖励
 * @property string $jc_ratio 极差奖励
 * @property string $jf_ratio 消费券
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereJcRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereJfRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel wherePv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereTjRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereUpdatedAt($value)
 * @property float $bazaar_pv 新增市场业绩
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ShopLevel whereBazaarPv($value)
 */
class ShopLevel extends Model
{
    protected $table = 'shop_level';

    public static function getName(){
        return self::pluck('real_name','id')->toArray();
    }

    public static function getLevels()
    {
        $redis_key = 'get_shop_levels_cache';
        $levels = Redis::get($redis_key);
        if($levels){
            $levels = json_decode($levels,true);
        }else{
            $level = self::get()->toArray();
            $levels = [];
            foreach ($level as $val){
                $levels[$val['id']] = $val;
            }
            Redis::set($redis_key,json_encode($levels),'ex',60);
        }
        return $levels;
    }
    //设置社区会员
    public static function setShopLowerMember(Member $member)
    {
        //首次成为社区调用
        $shop_member_id = $member->id;
        $member->shop_member_id = $shop_member_id;
        if($member->pid){
            $pid_shop_member_id  = Member::whereId($member->pid)->value('shop_member_id');
            $member->pid_shop_member_id = $pid_shop_member_id;
        }
        $member->save();

        $member_ids = [$member->id];
        do{
            Member::whereIn('pid',$member_ids)->where('shop_level','>',0)->update(['pid_shop_member_id'=>$shop_member_id]);
            $member_ids = Member::whereIn('pid',$member_ids)->where('shop_level',0)->pluck('id')->toArray();
            Member::whereIn('id',$member_ids)->update(['shop_member_id'=>$shop_member_id]);
        }while($member_ids);
    }
}
