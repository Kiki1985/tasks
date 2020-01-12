<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class ExpiredTasksController extends Controller
{
	public function show()
    {
	    $expiredTasks = Task::where('dateToFinish', '<', date('Y-m-d'))
	                ->orderBy('dateToFinish', 'asc')->get();
	    return($expiredTasks);
    }
}
