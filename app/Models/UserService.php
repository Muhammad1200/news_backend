<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function service()
    {
        return $this->hasOne(ServiceContent::class,'id','service_id');
    }
}
