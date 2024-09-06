<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\DivvyPvLogs
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DivvyPvLogs extends Model
{
    protected $table = 'divvy_pv_logs';

    public static function changeIntegral($amount,$member,$type,$action,$related_id = 0,$remark = ''){
        /** @var Member $member */
        $amount = abs($amount);
        $balance_before = $member->divvy_pv;
        if($type == 1){
            $balance_after = bcadd($balance_before,$amount,2);
        }else{
            $balance_after = bcsub($balance_before,$amount,2);
            $amount = -$amount;
        }
        $member->divvy_pv = $balance_after;
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
        $in_log = DivvyPvLogs::insertGetId($log_data);
        $success = $in_log && $member->save();
        return $success;
    }

}
