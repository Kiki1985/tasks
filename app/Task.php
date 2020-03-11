<?php

namespace App;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $dates = ['dateToFinish'];
    protected $dispatchesEvents = [
    	'created' =>TaskCreated::class,
    	'deleted' =>TaskDeleted::class,
    	'updated' =>TaskUpdated::class
    ];
}
