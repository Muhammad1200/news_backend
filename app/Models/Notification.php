<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    static public $relation = ['user','job'];

    /* @NOTIFICATION_TYPES */
    static public $MESSAGE = "MESSAGE";
    static public $JOB = "JOB";
    /* @NOTIFICATION_TYPES */

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function job()
    {
        return $this->hasOne(UserJob::class,'id','job_id');
    }

}
