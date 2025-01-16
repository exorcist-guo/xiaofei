<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Transfer
 *
 * @property int $id
 * @property int $member_id 转出人ID
 * @property int $c_member_id 收款人ID
 * @property float $amount 数量
 * @property float $fee 手续费
 * @property float $actual_amount 实际到账
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereActualAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereCMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Member $cmember
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer filterCmember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Transfer filterMember($memberId)
 */
class Transfer extends Model
{
    use BelongsToMember;
    protected $table = 'transfer';


    public function cmember()
    {
        return $this->belongsTo(Member::class, 'c_member_id', 'id');
    }

    public function scopeFilterCmember(Builder $query, $memberId)
    {
        $query->where('c_member_id', $memberId);
    }


}
