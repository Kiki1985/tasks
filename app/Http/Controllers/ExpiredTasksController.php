<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class ExpiredTasksController extends Controller
{
	public function show()
    {
	    $expired_tasks = Task::where('dateToFinish', '<=', date('Y-m-d'))
	                ->orderBy('dateToFinish', 'asc')->get();
	    return($expired_tasks);
    }
}
