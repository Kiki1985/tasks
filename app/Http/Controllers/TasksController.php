<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Jobs\SendEmailTaskCreatedJob;
use App\Jobs\SendEmailTaskDeletedJob;
use App\Jobs\SendEmailTaskUpdatedJob;

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
        SendEmailTaskCreatedJob::dispatch($task)
                ->delay(now()->addSeconds(5));
        return ($task);
    }

    public function destroy(Task $task)
    {
        SendEmailTaskDeletedJob::dispatch()
                ->delay(now()->addSeconds(5));
        $task->delete();
        return back();
    }

    public function update(Task $task)
    {
        $task->update($this->validateTask());
        SendEmailTaskUpdatedJob::dispatch()
                ->delay(now()->addSeconds(5));
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
