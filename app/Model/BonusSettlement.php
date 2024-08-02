<?php

namespace App\Model;

use App\Traits\AdminOperatorTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BonusSettlement
 *
 * @property int $id
 * @property int $status 结算状态
 * @property int $admin_id 操作员ID
 * @property int|null $start_time 开始时间
 * @property int|null $end_time 结束时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BonusSettlement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BonusSettlement extends Model
{
    use AdminOperatorTrait;
    protected $table = 'bonus_settlement';

    const STATUS_MAP = [
        1 => '任务创建成功',
        2 => '开始结算福利奖金',
        3 =>  '福利奖励结算完成',
        4 => '开始统计市场业绩',
        5 => '市场业绩结算成功',
        6 => '社区等级调整成功',
        7 => '开始发放社区奖励',

        20 => '结算完成',

    ];
}
