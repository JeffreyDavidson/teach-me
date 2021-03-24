<?php

namespace Tests\Integration\Events;

use App\Events\StudentCreated;
use App\Listeners\SendStudentWelcomeEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class StudentCreatedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function student_created_event_is_listened_to_by_send_welcome_email_listener()
    {
        Event::fake();

        Event::assertListening(StudentCreated::class, SendStudentWelcomeEmail::class);
    }
}
