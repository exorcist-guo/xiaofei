<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PostTemplate
 *
 * @property int $id
 * @property string $name 模版名称
 * @property string $mobanurl 模版URL
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate whereMobanurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PostTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostTemplate extends Model
{
    protected $table = 'post_template';
}
