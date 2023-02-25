<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static $PENDING = "PENDING"; /* @When job is created by customer */
    public static $CANCELED = "CANCELED"; /* @When job is cancel by customer */
    public static $ONGOING = "ONGOING"; /* @When job is accept by fixer */
    public static $STARTED = "STARTED"; /* @When job is Start By fixer */
    public static $END = "END"; /* @When job is end by fixer  */
    public static $APPROVED = "APPROVED"; /* @When job is approved by customer */

    public static $PAID = "PAID";
    public static $UNPAID = "UNPAID";

    public function address()
    {
        return $this->hasOne(Address::class,'id','address_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function fixer()
    {
        return $this->hasOne(User::class,'id','fixer_id');
    }

    public function service()
    {
        return $this->hasOne(ServiceContent::class,'id','service_id');
    }

    public function jobType()
    {
        return $this->hasOne(JobType::class,'id','job_type');
    }

    public function products()
    {
        return $this->hasMany(UserJobProduct::class,'user_job_id','id')
            ->with(['product']);
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class,'job_id','id');
    }

    public function survey()
    {
        return $this->hasOne(Survey::class,'job_id','id');
    }

    public function getAllJobs()
    {
        return self::with('address', 'user', 'fixer', 'service', 'jobType', 'products', 'transactions','survey')->get();
    }

    public function findJob($id)
    {
        return self::with('address', 'user', 'fixer', 'service', 'jobType', 'products', 'transactions','survey')->find($id);
    }
}
