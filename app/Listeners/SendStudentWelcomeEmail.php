<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Mail\WelcomeStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStudentWelcomeEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  App\Events\StudentCreated  $event
     * @return void
     */
    public function handle(StudentCreated $event)
    {
        Mail::to([
            $event->student->email,
            $event->student->school_email,
        ])
        ->queue(new WelcomeStudent($event->student));
    }
}
