<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function dispatchs(){

        return $this->hasMany(Dispatch::class);
    }
}
