<?php

namespace App\Model;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Message
 *
 * @property int $id
 * @property int $member_id
 * @property int $type 类型
 * @property int $admin_id 操作员ID
 * @property string $mobile 联系电话
 * @property string $name 姓名
 * @property int $status  0未回复,1已回复
 * @property string $question 问题
 * @property string $reply 回复
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    use BelongsToMember;
    protected $table = 'message';

    const  TYPE_MAP = [
        1 => '银行卡反馈',
        2 => '其他问题咨询',
    ];

}
