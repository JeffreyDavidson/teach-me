<?php

namespace App\Listeners;

use App\Events\SemesterCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GenerateSemesterSchedule implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  App\Events\SemesterCreated  $event
     * @return void
     */
    public function handle(SemesterCreated $event)
    {
        if (Str::of($event->semester->name)->startsWith('Spring')) {
            $defaultSpringCourses = [];
            foreach ($defaultSpringCourses as $defaultSpringCourse) {
                $semesterCourse = $event->semester->courses()->attach($defaultSpringCourse);
                dd($semesterCourse);
            }
        } elseif (Str::of($event->semester->name)->startsWith('Summer')) {
        } elseif (Str::of($event->semester->name)->startsWith('Fall')) {
        }
    }
}
