<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dispatch;
use Illuminate\Database\Eloquent\Model;

class DispatchDetails extends Model
{
public function dispatch()
{
    return $this->belongsTo(Dispatch::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
public function scopeOfAssignedToMe($query)
{
    return $query->where('user_id', auth()->user()->id);
}
}
