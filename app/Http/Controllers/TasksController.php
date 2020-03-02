<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Mail\TaskCreated;
use App\Mail\TaskDeleted;
use App\Mail\TaskUpdated;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('dateToFinish', 'asc')->get();
        return view('index', compact('tasks'));
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
        \Mail::to('tasks@test.com')->send(
            new TaskCreated($task)
        );
        return ($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        \Mail::to('tasks@test.com')->send(
            new TaskDeleted($task)
        );
        return back();
    }

    public function update(Task $task)
    {
        $task->update(request()->validate([
                'title'=>'required',
                'description'=>'required',
                'dateToFinish'=>'required'
                ]));
        \Mail::to('tasks@test.com')->send(
            new TaskUpdated($task)
        );
        return redirect('/tasks');
    }
}
