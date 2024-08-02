<?php

namespace App;

use App\Traits\BelongsToMember;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use BelongsToMember;
    protected $table = 'login_log';

}
