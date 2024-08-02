<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PostMember
 *
 * @property int $id
 * @property int $status 0 未导入 1弃用,2导入,4异常
 * @property int $pici 导入批次
 * @property string $mobile
 * @property string $pid_id_number 上级身份证号
 * @property string $number 账号
 * @property string $real_name 真实姓名
 * @property string $id_number 身份证号
 * @property string $error 错误
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember wherePici($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember wherePidIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostMember extends Model
{
    protected $table = 'post_member';
    //0待检验 1弃用, 3异常,4待导入,6导入异常 7成功
    const STATUS_MAP = [
        0 => '待检验',
        1 => '弃用',
        3 => '异常',
        4 => '待导入',
        6 => '导入异常',
        7 => '成功'
    ];


}
