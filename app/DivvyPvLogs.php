<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\DivvyPvLogs
 *
 * @property int $id
 * @property int $member_id
 * @property float $amount 变动数量
 * @property float $award_amount 奖励数量
 * @property int $s_member_id
 * @property float $s_award_amount 上级奖励数量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereAwardAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereSAwardAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereSMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DivvyPvLogs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DivvyPvLogs extends Model
{
    protected $table = 'divvy_pv_logs';

}
