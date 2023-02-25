<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceContent extends Model
{
    protected $guarded = [];
    protected $appends = ['app_icon_url','web_icon_url'];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
    public function service(){
        return $this->hasMany(ServiceAmountType::class,'service_id');
    }

    public function getAppIconUrlAttribute()
    {
        return asset('storage/'.$this->app_icon);
    }
    public function getWebIconUrlAttribute()
    {
        return asset('storage/'.$this->web_icon);
    }

    public function updateStatus($id, $data = [])
    {
        return self::where(['id'=>$id])->update($data);
    }
}
