<?php

namespace App\Listeners;

use App\Events\TeacherCreated;
use App\Mail\WelcomeTeacher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  App\Events\TeacherCreated  $event
     * @return void
     */
    public function handle(TeacherCreated $event)
    {
        Mail::to([
            $event->teacher->email,
            $event->teacher->school_email,
        ])
        ->queue(new WelcomeTeacher($event->teacher));
    }
}
