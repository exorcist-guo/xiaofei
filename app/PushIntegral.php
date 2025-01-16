<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\PushIntegral
 *
 * @property int $id
 * @property int $member_id
 * @property int $status  1推送中,2推送成功
 * @property float $amount 数量
 * @property int $star_amount 铸源星数量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereStarAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushIntegral whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PushIntegral extends Model
{
    use BelongsToMember;
    protected $table = 'push_integral';

}
