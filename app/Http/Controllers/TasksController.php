<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Expired;
use DB;


class TasksController extends Controller
{
    public function index(){
        $date = date('Y-m-d');
    	$tasks = DB::table('tasks')->where('expected_finish_date', '>=', $date)->orderBy('expected_finish_date', 'asc')->get();
			return view('index', compact('tasks', 'date'));
    }

    public function create(){
    	return view('create');
    }

    public function store(){
        $date = date('Y-m-d');
    	$this->validate(request(), [
    			'title'=>'required',
    			'description'=>'required',
    			'expected_finish_date'=>'required'
    	]);
        if(request('expected_finish_date') < $date){
            return back();
        }else
        Task::create(request(['title', 'description', 'expected_finish_date']));
         return redirect('/');
    }

    public function show(Task $task){
    	return view('tasks.show', compact('task'));
    }

    public function date(){
        $date = date('Y-m-d');
            return response($date); 
        
    }


    public function expired_tasks(){
        $date = date('Y-m-d');
        $expired_tasks = DB::table('tasks')->where('expected_finish_date', '<', $date)->orderBy('expected_finish_date', 'asc')->get();
            return view('expired', compact('expired_tasks', 'date'));
    }

   
    
}
