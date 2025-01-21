<?php

namespace App;

use App\Exceptions\BizException;
use App\Traits\BelongsToMember;
use App\Traits\SubmeterModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\IntegralLogs
 *
 * @property int $id
 * @property int $member_id
 * @property int $action 类型ID
 * @property float $amount 变动数量
 * @property float $balance_before 变动后数量
 * @property float $balance_after 变动前数量
 * @property string $remark
 * @property int $related_id 关联id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralLogs filterMember($memberId)
 */
class IntegralLogs extends Model
{
    use SubmeterModelTrait,BelongsToMember;
    protected $table = 'integral_logs';

    const STATUS_MAP = [
        1 => '商城增加',
        2 => '转入',
        3 => '提现失败',

        4 => '极差奖励',
        5 => '推荐奖励',
        6 => '服务奖励',
        7 => '服务补贴',
        8 => '促销奖励',
        10 => '福利奖励',

        11 => '推送',
        12 => '提现',
        13 => '转出',
        14 => '后台减少',
    ];

    //type == 1 增加  0 减少
    public static function changeIntegral($amount,$member,$type,$action,$related_id = 0,$remark = ''){
        /** @var Member $member */
        $amount = abs($amount);
        $balance_before = $member->integral;
        if($type == 1){
            $balance_after = bcadd($balance_before,$amount,2);
            $member->all_integral = bcadd($member->all_integral,$amount,2);
        }else{
            $balance_after = bcsub($balance_before,$amount,2);
            $amount = -$amount;
        }
        $member->integral = $balance_after;
        $time = date('Y-m-d H:i:s');

        $log_data = [
            'member_id' => $member->id,
            'action' => $action,
            'amount' => $amount,
            'balance_before' => $balance_before,
            'balance_after' => $balance_after,
            'remark' => $remark,
            'related_id' => $related_id,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        $in_log = IntegralLogs::setSuffix($member->id,1)->insertGetId($log_data);
        $success = $in_log && $member->save();
        return $success;
    }
}
