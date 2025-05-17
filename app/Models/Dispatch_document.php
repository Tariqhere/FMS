<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch_document extends Model
{
   public function users(){

    return $this->hasMany(Dispatch::class);
}

}
