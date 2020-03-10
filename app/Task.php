<?php

namespace App;

use App\Jobs\SendEmailTaskCreatedJob;
use App\Jobs\SendEmailTaskDeletedJob;
use App\Jobs\SendEmailTaskUpdatedJob;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['dateToFinish'];

    protected static function boot()
    {
    	parent::boot();
    	static::created(function($task){
    		SendEmailTaskCreatedJob::dispatch($task)
                ->delay(now()->addSeconds(5));
    	});
    	static::deleted(function(){
    		SendEmailTaskDeletedJob::dispatch()
                ->delay(now()->addSeconds(5));
    	});
    	static::updated(function(){
    		SendEmailTaskUpdatedJob::dispatch()
                ->delay(now()->addSeconds(5));
    	});
    }
}
