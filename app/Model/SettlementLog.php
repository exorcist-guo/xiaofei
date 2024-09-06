<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SettlementLog
 *
 * @property int $id
 * @property int $bonus_settlement_id 结算id
 * @property int $member_id 用户id
 * @property int $type 类型
 * @property float $amount 收益
 * @property int $related_id 关联id
 * @property float $yuan_amount 计算基数
 * @property string $ratio 结算比率
 * @property string $remark 备注
 * @property float $balance_before 变动后数量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereBonusSettlementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereYuanAmount($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SettlementLog whereStatus($value)
 */
class SettlementLog extends Model
{
    protected $table = 'settlement_log';

    public function addLog()
    {

    }

}
