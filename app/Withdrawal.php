<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

/**
 * App\Withdrawal
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $member_id
 * @property int $status 0待审核,1审核失败,2已完成
 * @property float $amount 数量
 * @property float $fee 手续费
 * @property float $actual_amount 实际到账
 * @property string $name 姓名
 * @property string $card_name 银行名称
 * @property string $card_number 银行卡号
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereActualAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereUpdatedAt($value)
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal filterMember($memberId)
 * @property string|null $notes 原因
 * @property string|null $error_msg 失败原因
 * @property string|null $order_no
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereErrorMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereOrderNo($value)
 * @property string|null $rate 汇率
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Withdrawal whereRate($value)
 */
class Withdrawal extends Model
{
    use BelongsToMember;
    protected $table = 'withdrawal';

    const STATUS_MAP = [
        0 => '待审核',
        1 => '驳回',
        2 => '已打款',
        4 => '打款失败',
    ];

    public static function getCardName(){
        $key = 'config_card_names';
        $names = Redis::get($key);
        if(!$names){
           $names = config('base.card_names');
           Redis::set($key,$names,'ex',60);
        }
        return explode(',',$names);
    }

}
