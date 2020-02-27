<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('dateToFinish', 'asc')->get();
        return view('index', compact('tasks', 'expireds'));
    }

    public function store(Request $request)
    {
        if (request('dateToFinish') < date('Y-m-d')) {
            return back();
        }
        $task = Task::create(request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3'],
            'dateToFinish'=>'required'
            ]));
        return ($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }

    public function update(Task $task)
    {
        $task->update(request()->validate([
                'title'=>'required',
                'description'=>'required',
                'dateToFinish'=>'required'
                ]));
        return redirect('/tasks');
    }
}
