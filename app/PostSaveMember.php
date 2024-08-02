<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSaveMember extends Model
{
    protected $table = 'post_save_member';

    const STATUS_MAP = [
        0 => '待检验',
        1 => '弃用',
        3 => '异常',
        4 => '待导入',
        6 => '导入异常',
        7 => '成功'
    ];

}
