<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image);
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

}
