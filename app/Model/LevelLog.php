<?php

namespace App\Model;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\LevelLog
 *

 * @mixin \Eloquent
 * @property int $id
 * @property int $member_id
 * @property int $action 类型
 * @property int $type 1等级 2社区等级
 * @property float $level_before 变动前等级
 * @property float $level_after 变动后等级
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereLevelAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereLevelBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LevelLog whereUpdatedAt($value)
 */
class LevelLog extends Model
{
    use BelongsToMember;
    protected $table = 'level_log';

    const ACTION_MAP = [
        1 => '条件升级',
        2 => '后台调整',
        12 => '条件降级',
    ];

    const TYPE_MAP = [
        1 => '会员等级',
        2 => '社区等级',
    ];
    public static function addLevelLog($member,$level,$action,$type = 1)
    {
        if($type == 1){
            $level_before = $member->level;
        }else{
            $level_before = $member->shop_level;
        }

        $level_log = new LevelLog();
        $level_log->member_id = $member->id;
        $level_log->action = $action;
        $level_log->type = $type;
        $level_log->level_before = $level_before;
        $level_log->level_after = $level;

        return $level_log->save();
    }
}
