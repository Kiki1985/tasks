<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $task = Task::create(request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3'],
            'dateToFinish'=>'required'
            ]));
        return ($task);
        
    }

    public function show()
    {
        $tasks = Task::orderBy('dateToFinish', 'asc')->get();
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