<?php

namespace App\Jobs;

use App\Mail\TaskCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailTaskCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $task;
    /**
     * Create a new job instance.z
     *
     * @return void
     */
    public function __construct($task)
    {
       $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to('tasks@test.com')->send(
            new TaskCreated($this->task)
        );
    }
}
