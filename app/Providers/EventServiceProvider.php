<?php

namespace App\Providers;

use App\Events\SemesterCreated;
use App\Events\StudentCreated;
use App\Events\TeacherCreated;
use App\Listeners\GenerateSemesterSchedule;
use App\Listeners\SendStudentWelcomeEmail;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TeacherCreated::class => [
            SendWelcomeEmail::class,
        ],
        StudentCreated::class => [
            SendStudentWelcomeEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
