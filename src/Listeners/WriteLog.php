<?php

namespace Yahyya\taskmanager\Listeners;
use Illuminate\Support\Facades\Log;
use Yahyya\taskmanager\Events\BookIsAssignedToAnAuthor;

class WriteLog
{
    public function handle(BookIsAssignedToAnAuthor $event)
    {
        Log::notice('Task ' . $event->task->title . ' Status was closed!');
    }
}
