<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use DB;

class TasksController extends Controller
{
    public function index(){
        $date = date('Y-m-d');
    	$tasks = DB::table('tasks')->where('expected_finish_date', '>=', $date)->orderBy('expected_finish_date', 'asc')->get();
        $expired_tasks = DB::table('tasks')->where('expected_finish_date', '<', $date)->orderBy('expected_finish_date', 'asc')->get();
			return view('index', compact('tasks', 'date', 'expired_tasks'));
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
        }else{
        $task = new Task;
        $task->title = request('title');
        $task->description = request('description');
        $task->expected_finish_date = request('expected_finish_date');
        $task->save();
        
        return response($task);
        }
               
    }

    public function show(Task $task){
    	return view('tasks.show', compact('task'));
    }

    public function date(){
        $date = date('Y-m-d');
            return response($date); 
    }

    public function showTask(){
        $date = date('Y-m-d');
        $tasks = DB::table('tasks')->where('expected_finish_date', '>=', $date)->orderBy('expected_finish_date', 'asc')->get();
        return($tasks);

    }
}
