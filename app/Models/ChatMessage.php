<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Jobs\Job;

class ChatMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['file_url'];

    static public $relationsMethods = ['fromUser','toUser','job'];

    public function getFileUrlAttribute()
    {
        return asset('storage/'.$this->file);
    }

    public function fromUser()
    {
        return $this->hasOne(User::class,'id','from');
    }

    public function toUser()
    {
        return $this->hasOne(User::class,'id','to');
    }

    public function job()
    {
        return $this->hasOne(UserJob::class,'id','job_id');
    }

    public function getChatMessagesWhere($where = [])
    {
        return self::where($where)->with('fromUser','toUser','job')->get();
    }

}
