<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



/**
 * App\Model\NewPerformance
 *
 * @property int $id
 * @property int $member_id
 * @property int $status 0 未发放 1已发放
 * @property int $bonus_id 结算id
 * @property int $type 1个人业绩  2市场业绩
 * @property float $performance 新增业绩
 * @property float $grant 发放金额
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereBonusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereGrant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance wherePerformance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewPerformance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewPerformance extends Model
{
    protected $table = 'new_performance';
}
