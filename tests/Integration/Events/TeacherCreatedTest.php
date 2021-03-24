<?php

namespace Tests\Integration\Events;

use App\Events\TeacherCreated;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TeacherCreatedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teacher_created_event_is_listened_to_by_send_welcome_email_listener()
    {
        Event::fake();

        Event::assertListening(TeacherCreated::class, SendWelcomeEmail::class);
    }
}
