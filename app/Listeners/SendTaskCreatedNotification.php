<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Jobs\SendEmailTaskCreatedJob;

class SendTaskCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  TaskCreated  $event
     * @return void
     */
    public function handle(TaskCreated $event)
    {
        SendEmailTaskCreatedJob::dispatch($event->task)
            ->delay(now()->addSeconds(5));
    }
}
