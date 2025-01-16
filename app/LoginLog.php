<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\LoginLog
 *
 * @property int $id
 * @property int $member_id
 * @property string $ip 登录IP
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog filterMember($memberId)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LoginLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoginLog extends Model
{
    use BelongsToMember;
    protected $table = 'login_log';

}
