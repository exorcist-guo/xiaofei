<?php

namespace App;

use App\Traits\BelongsToMember;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

/**
 * App\PostSaveMember
 *
 * @property int $id
 * @property int $member_id
 * @property int $admin_id 操作员ID
 * @property int $status 0待检验 1弃用, 3异常,4待导入,6修改异常 7成功
 * @property int $type 1会员信息修改,2修改等级，3修改积分,4修改营业额
 * @property int $pici 导入批次
 * @property string $content 内容
 * @property string $val 原始内容
 * @property string $error 错误
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereAuditeAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember wherePici($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostSaveMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostSaveMember extends Model
{
    use BelongsToMember;
    protected $table = 'post_save_member';

    const STATUS_MAP = [
        0 => '待检验',
        1 => '弃用',
        3 => '异常',
        4 => '待导入',
        6 => '导入异常',
        7 => '成功'
    ];

    const TYPE_MAP = [
        1 => '会员信息修改',
        2 => '会员等级修改',
        3 => '会员积分修改',
        4 => '修改营业额',
        5 => '修改状态',
        6 => '修改上级',
        7 => '社区等级修改',
        8 => '社区等级防降级',
        9 => '冻结消费券修改',
        10 => '可用消费券修改',
    ];


    const TITLE_MAP = [
        '会员等级' => 2,
        '积分' => 3,
        '营业额' => 4,
        '会员状态' => 5,
        '社区等级' => 7,
        '冻结消费券' => 9,
        '可用消费券' => 10,
    ];

    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }

    public function scopeOperatorMember(Builder $query, $memberId)
    {
        $query->where('admin_id', $memberId);
    }

    public function audite()
    {
        return $this->belongsTo(Administrator::class, 'audite_admin_id', 'id');
    }

    public function scopeAuditeMember(Builder $query, $memberId)
    {
        $query->where('audite_admin_id', $memberId);
    }

}
