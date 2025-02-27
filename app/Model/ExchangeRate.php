<?php

namespace App\Model;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\ExchangeRate
 *
 * @property int $id
 * @property string|null $rate
 * @property int|null $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Encore\Admin\Auth\Database\Administrator|null $audite
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate auditeMember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $status 0 使用中 1 停用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate whereStatus($value)
 * @property-read \Encore\Admin\Auth\Database\Administrator|null $operator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ExchangeRate operatorMember($memberId)
 */
class ExchangeRate extends Model
{
    protected $table = 'exchange_rate';

    const STATUS_MAP = [
        0 => '使用中',
        1 => '停用',
    ];

    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }

    public function scopeOperatorMember(Builder $query, $memberId)
    {
        $query->where('admin_id', $memberId);
    }

}
