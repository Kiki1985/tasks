<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::where('dateToFinish', '>=', date('Y-m-d'))
                ->orderBy('dateToFinish', 'asc')->get();

        $expiredTasks = Task::where('dateToFinish', '<', date('Y-m-d'))
                        ->orderBy('dateToFinish', 'asc')->get();

		return view('index', compact('tasks', 'expiredTasks'));
    }

    public function store(Request $request)
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
