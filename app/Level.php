<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

/**
 * App\Level
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $real_name 名称
 * @property float $pv 营业额
 * @property string $tj_ratio 推荐奖励
 * @property string $jc_ratio 极差奖励
 * @property string $jf_ratio 积分
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereJcRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereJfRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level wherePv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereTjRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereUpdatedAt($value)
 */
class Level extends Model
{
    protected $table = 'level';

    public static function getName(){
        return self::pluck('real_name','id')->toArray();
    }

    public static function getLevels()
    {
        $redis_key = 'get_levels_cache';
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


}
