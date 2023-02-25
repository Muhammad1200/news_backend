<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAddition extends Model
{
    protected $guarded = [];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
