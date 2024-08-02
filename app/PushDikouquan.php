<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PushDikouquan
 *
 * @property int $id
 * @property int $member_id
 * @property int $status  1推送中,2推送成功
 * @property float $amount 数量
 * @property int $dikou_amount 抵扣券数量
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereDikouAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushDikouquan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PushDikouquan extends Model
{
    protected $table = 'push_dikouquan';
}
