<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch_detail_document extends Model
{
       public function dispatch(){

    return $this->hasMany(Dispatch::class);
}
}
