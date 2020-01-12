<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');

    	$tasks = Task::where('dateToFinish', '>=', $date)
                ->orderBy('dateToFinish', 'asc')->get();

        $expiredTasks = Task::where('dateToFinish', '<', $date)
                        ->orderBy('dateToFinish', 'asc')->get();

		return view('index', compact('tasks', 'date', 'expiredTasks'));
    }

    public function store()
    {
        if(request('dateToFinish') < date('Y-m-d')){
        return back();
        }else{
        $task = Task::create(request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3'],
            'dateToFinish'=>'required'
            ]));
        return ($task);
        }
    }

    public function date()
    {
        $date = date('Y-m-d');
        return response($date); 
    }

    public function show()
    {
        $tasks = Task::where('dateToFinish', '>=', date('Y-m-d'))
                ->orderBy('dateToFinish', 'asc')->get();
        return($tasks);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task)
    {
        $task->update(request()->validate([
                'title'=>'required',
                'description'=>'required',
                'dateToFinish'=>'required'
                ]));
        return redirect('/');
    }
}
