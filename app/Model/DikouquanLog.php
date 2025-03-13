<?php

namespace App\Model;

use App\Traits\BelongsToMember;
use App\Traits\SubmeterModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\DikouquanLog
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog filterMember($memberId)
 * @property int|null $type 1冻结 2激活
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DikouquanLog whereType($value)
 */
class DikouquanLog extends Model
{
    use BelongsToMember;

    protected $table = 'dikouquan_log';

    const STATUS_MAP = [
        1 => '后台增加',    //冻结
        2 => '后台增加',    //激活部分
        4 => '转入',
        5 =>'可用抵扣券激活增加',
        6 => '后台转入',

        11 => '推送',
        12 => '后台减少', //冻结
        13 => '后台减少', //激活部分
        14 => '转出',
        15 =>'冻结抵扣券减少',
        16 => '后台转出',

    ];

    const TYPE_MAP = [
        1 => '冻结抵扣券',
        2 => '可用抵扣券',
    ];


    public static function changeIntegral($amount,$member,$type,$action,$related_id = 0,$remark = ''){
        /** @var Member $member */
        $amount = abs($amount);
        $balance_before = $member->dikouquan;
        if($type == 1){
            $balance_after = bcadd($balance_before,$amount,2);

        }else{
            $balance_after = bcsub($balance_before,$amount,2);
            $amount = -$amount;
        }
        $member->dikouquan = $balance_after;
        $time = date('Y-m-d H:i:s');

        $log_data = [
            'member_id' => $member->id,
            'action' => $action,
            'amount' => $amount,
            'type' => 1, //冻结
            'balance_before' => $balance_before,
            'balance_after' => $balance_after,
            'remark' => $remark,
            'related_id' => $related_id,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        $in_log = DikouquanLog::insertGetId($log_data);
        $success = $in_log && $member->save();
        return $success;
    }

    public static function changeIntegralK($amount,$member,$type,$action,$related_id = 0,$remark = ''){
        /** @var Member $member */
        $amount = abs($amount);
        $balance_before = $member->dikouquan_k;
        if($type == 1){
            $balance_after = bcadd($balance_before,$amount,2);

        }else{
            $balance_after = bcsub($balance_before,$amount,2);
            $amount = -$amount;
        }
        $member->dikouquan_k = $balance_after;
        $time = date('Y-m-d H:i:s');

        $log_data = [
            'member_id' => $member->id,
            'action' => $action,
            'amount' => $amount,
            'type' => 2, // 可用
            'balance_before' => $balance_before,
            'balance_after' => $balance_after,
            'remark' => $remark,
            'related_id' => $related_id,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        $in_log = DikouquanLog::insertGetId($log_data);
        $success = $in_log && $member->save();
        return $success;
    }

}
