<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;


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
        $task = Task::create($this->validateTask());
        event(new TaskCreated($task));
        return ($task);
    }

    public function destroy(Task $task)
    {
        event(new TaskDeleted());
        $task->delete();
        return back();
    }

    public function update(Task $task)
    {
        event(new TaskUpdated($task));
        $task->update($this->validateTask());
        return redirect('/tasks');
    }

    protected function validateTask()
    {
        return request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3'],
            'dateToFinish'=>'required'
        ]);
    }
}
