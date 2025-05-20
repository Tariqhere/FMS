<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'flag_id',
        'user_id',
        'office_id',
        'title',
        'description',
        'remark',
        'dispatch_date',
        'complete_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function flag()
    {
        return $this->belongsTo(Flag::class);
    }

    public function documents()
    {
        return $this->hasMany(DispatchDocument::class);
    }
}