<?php

namespace App;

use App\Traits\BelongsToMember;
use App\Traits\SubmeterModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\PvLogs
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvLogs filterMember($memberId)
 */
class PvLogs extends Model
{
    use SubmeterModelTrait,BelongsToMember;
    protected $table = 'pv_logs';

    const STATUS_MAP = [
        1 => '商城推送',
        2 => '后台增加'
    ];

}
