<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\PvOrder
 *
 * @property int $id
 * @property int $member_id
 * @property string $mobile 手机号
 * @property float $amount 变动数量
 * @property string $order_no 订单号
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereStatus($value)
 * @property float|null $cash_amount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PvOrder whereCashAmount($value)
 */
class PvOrder extends Model
{
    use BelongsToMember;
    protected $table = 'pv_order';
    const ACTION_MAP = [
        1 => '商城增加',
    ];

//    protected function asDateTime($value) {
//        return $value;
//    }
}
