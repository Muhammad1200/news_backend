<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function serviceAmount()
    {
        return $this->hasOne(ServiceAmountType::class,'job_type_id','id');
    }
}
