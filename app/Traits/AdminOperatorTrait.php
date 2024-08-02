<?php

namespace App\Traits;

use Encore\Admin\Auth\Database\Administrator;

trait AdminOperatorTrait
{
    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }

    public function scopeOperatorMember(Builder $query, $memberId)
    {
        $query->where('admin_id', $memberId);
    }
}
