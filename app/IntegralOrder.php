<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\IntegralOrder
 *
 * @property int $id
 * @property int $member_id
 * @property string $mobile 手机号
 * @property float $amount 变动数量
 * @property string $order_no 订单号
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IntegralOrder whereStatus($value)
 */
class IntegralOrder extends Model
{
    protected $table = 'integral_order';

}
