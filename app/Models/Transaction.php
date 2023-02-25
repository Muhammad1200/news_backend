<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function job()
    {
        return $this->hasOne(UserJob::class,'id','job_id');
    }
}
