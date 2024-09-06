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

    const TYPE_MAP = [
        1 => '推新奖励',
        2 => '消费奖励',
    ];

    public function addLog($amount,$yuan_amount,$settlement_member,$type,$related_id = 0,$remark = ''){
        /** @var SettlementMember $settlement_member */
        $amount = abs($amount);
        switch ($type){
            case 1:
            case 2:
                $balance_after = bcadd((string)$settlement_member->jh,(string)$amount,2);
                $settlement_member->jh = $balance_after;
                break;
        }
        $time = date('Y-m-d H:i:s');
        $log_data = [
            'bonus_settlement_id' => $settlement_member->bonus_settlement_id,
            'member_id' => $settlement_member->member_id,
            'type' => $type,
            'amount' => $amount,
            'yuan_amount' => $yuan_amount,
            'balance_after' => $balance_after,
            'remark' => $remark,
            'related_id' => $related_id,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        $in_log = self::InsertGetId($log_data);
        $success = $in_log && $settlement_member->save();
        return $success;
    }

}
