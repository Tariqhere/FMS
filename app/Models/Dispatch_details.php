<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch_details extends Model
{
    public function user(){

    return $this->belongsTo(User::class);
}
   public function dispatch(){

    return $this->belongsTo(Dispatch::class);
}
}
