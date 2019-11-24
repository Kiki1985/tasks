<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;


class TasksController extends Controller
{
    public function index(){
    	$tasks = DB::table('tasks')->orderBy('expected_finish_date', 'asc')->get();
			return view('index', compact('tasks'));
    }

    public function create(){
    	return view('create');
    }

    public function store(){
    	$this->validate(request(), [
    			'title'=>'required',
    			'description'=>'required',
    			'expected_finish_date'=>'required'
    	]);
    	
		Task::create(request(['title', 'description', 'expected_finish_date']));
		return back();
    }

    public function show(Task $task){
    	return view('tasks.show', compact('task'));
    }

    public function date(){
        $date = date('Y-m-d');
        if(request('expected_finish_date') < $date)
            DB::table('tasks')->where('expected_finish_date', '<', $date)->delete();
            return response($date); 
        
    }
}
