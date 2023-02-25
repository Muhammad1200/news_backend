<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['file_url','sender_type_text','status_text'];

    public function getFileUrlAttribute()
    {
        return asset('storage/'.$this->file);
    }

    public function getSenderTypeTextAttribute()
    {
        return ($this->sender_type == "1")? 'User' : 'Admin';
    }

    public function getStatusTextAttribute()
    {
        return ($this->status == "1")? 'Active' : 'In-Active';
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
