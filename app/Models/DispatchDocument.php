<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_id',
        'title',
        'file',
        'status'
    ];

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }
}