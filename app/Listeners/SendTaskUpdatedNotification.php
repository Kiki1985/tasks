<?php

namespace App\Listeners;

use App\Events\TaskUpdated;
use App\Jobs\SendEmailTaskUpdatedJob;

class SendTaskUpdatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskUpdated  $event
     * @return void
     */
    public function handle(TaskUpdated $event)
    {
        SendEmailTaskUpdatedJob::dispatch($event->task)
            ->delay(now()->addSeconds(5));
    }
}
