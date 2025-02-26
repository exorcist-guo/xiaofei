<?php

namespace App\Model;

use App\Traits\BelongsToMember;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MemberExamine
 *
 * @property int $id
 * @property int|null $member_id
 * @property string|null $number
 * @property string|null $mobile
 * @property string|null $real_name
 * @property string|null $id_number
 * @property int|null $nation
 * @property string|null $certificate_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereCertificateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereNation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $is_disabled
 * @property string|null $msg
 * @property string|null $certificate_image
 * @property int|null $audite_admin_id
 * @property-read \Encore\Admin\Auth\Database\Administrator|null $audite
 * @property-read \App\Member|null $member
 * @property-read \Encore\Admin\Auth\Database\Administrator $operator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine auditeMember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine filterMember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine operatorMember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereAuditeAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereCertificateImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MemberExamine whereMsg($value)
 */
class MemberExamine extends Model
{
    use BelongsToMember;
    protected $table = 'member_examine';

    const IS_DISABLED_MAP = [
        6 => '通过',
        7 => '待审核',
        8 => '审核失败',

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
