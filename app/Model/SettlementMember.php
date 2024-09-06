<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\model\SettlementMember
 *
 * @property int $id
 * @property int $bonus_settlement_id 结算id
 * @property int $member_id 用户id
 * @property float $jh 激活数量
 * @property float $jc 极差
 * @property float $tj 推荐
 * @property float $fw 服务
 * @property float $bt 补贴
 * @property float $cx 促销奖
 * @property float $yj 业绩
 * @property int|null $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereBonusSettlementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereBt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereCx($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereFw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereJc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereJh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereTj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereYj($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\model\SettlementMember whereStatus($value)
 */
class SettlementMember extends Model
{
    protected $table = 'settlement_member';
}
