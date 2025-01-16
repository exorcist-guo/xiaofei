<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;


class MemberTree extends Model
{
    use ModelTree;

    protected $table = 'members';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('id');
        $this->setTitleColumn('number');
    }
}
