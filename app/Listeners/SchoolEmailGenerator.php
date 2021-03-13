<?php

namespace App\Listeners;

use Illuminate\Support\Str;

class SchoolEmailGenerator
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $schoolEmail = Str::lower($event->teacher->first_name.'.'.$event->teacher->last_name.'@'.config('school.domain'));

        $event->teacher()->update(['school_email' => $schoolEmail]);
    }
}
