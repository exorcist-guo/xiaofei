<?php

namespace App;

use App\Traits\SubmeterModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Shop
 *
 * @property int $id
 * @property string|null $name 店名
 * @property string|null $cookie
 * @property int|null $status 0 cookie 失效  1 有效
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCookie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Shop extends Model
{
    use SubmeterModelTrait;
    protected $table = 'shop';
    protected $guarded = [];




}
