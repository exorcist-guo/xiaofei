<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Proclamation
 *
 * @property int $id
 * @property string|null $title
 * @property string $description
 * @property string $abstract
 * @property int $issue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_hot
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proclamation whereSort($value)
 */
class Proclamation extends Model
{
    protected $table = 'proclamation';
}
