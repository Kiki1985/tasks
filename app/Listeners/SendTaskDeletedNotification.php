<?php

namespace App\Listeners;

use App\Events\TaskDeleted;
use App\Jobs\SendEmailTaskDeletedJob;

class SendTaskDeletedNotification
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
     * @param  TaskDeleted  $event
     * @return void
     */
    public function handle(TaskDeleted $event)
    {
        SendEmailTaskDeletedJob::dispatch()
            ->delay(now()->addSeconds(5));
    }
}
