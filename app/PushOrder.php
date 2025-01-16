<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PushOrder
 *
 * @property int $id
 * @property int $status
 * @property string $order_no 订单号
 * @property string $type 类型
 * @property int $related_id 关联id
 * @property string $content 详细内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereRelatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PushOrder extends Model
{
    protected $table = 'push_order';

    public static function pushMember(Member $user){
        $push_order = new PushOrder();
        $push_order->order_no = Member::getTradeNo('PU'.date('ymd'));
        $push_order->status = 0;
        $push_order->type = 'member';
        $push_order->related_id = $user->id;
        $push_order->content = json_encode([
            'mobile' => $user->mobile,
            'real_name' => $user->real_name,
            'id_number' => $user->id_number,
        ]);
        $push_order->save();
    }

    public static function pushIntegral(Member $user,$push_integral){
        $push_order = new PushOrder();
        $push_order->order_no = Member::getTradeNo('PU'.date('ymd'));
        $push_order->status = 0;
        $push_order->type = 'integral';
        $push_order->related_id = $push_integral->id;
        $push_order->content = json_encode([
            'mobile' => $user->mobile,
            'number' => $user->number,
            'amount' => $push_integral->amount,
            'star_amount' => $push_integral->star_amount,
        ]);
        $push_order->save();
    }

    public static function pushDikouquan(Member $user,$push_integral){
        $push_order = new PushOrder();
        $push_order->order_no = Member::getTradeNo('DK'.date('ymd'));
        $push_order->status = 0;
        $push_order->type = 'dikouquan';
        $push_order->related_id = $push_integral->id;
        $push_order->content = json_encode([
            'mobile' => $user->mobile,
            'number' => $user->number,
            'amount' => $push_integral->amount,
            'dikou_amount' => $push_integral->dikou_amount,
        ]);
        $push_order->save();
    }

}
