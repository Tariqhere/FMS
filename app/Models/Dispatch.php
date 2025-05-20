<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
public function user(){

    return $this->belongsTo(User::class);
}
public function office(){

    return $this->belongsTo(Office::class);
}
public function flag(){

    return $this->belongsTo(Flag::class);
}

}
