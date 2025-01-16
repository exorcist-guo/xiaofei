<?php

namespace App\Model;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ShopNumber
 *
 * @property int $id
 * @property int $member_id
 * @property int|null $number 组号
 * @property int $status 0 失效 1有效
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ShopNumber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopNumber extends Model
{
    use BelongsToMember;
    protected $table = 'shop_number';

}
