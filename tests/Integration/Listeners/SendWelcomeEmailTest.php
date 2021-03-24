<?php

namespace Tests\Integration\Listeners;

use App\Events\TeacherCreated;
use App\Listeners\SendWelcomeEmail;
use App\Mail\WelcomeTeacher;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendWelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function welcome_email_is_sent_when_teacher_is_created()
    {
        Mail::fake();

        $teacher = Teacher::factory()->create();

        (new SendWelcomeEmail)->handle(new TeacherCreated($teacher));

        Mail::assertQueued(WelcomeTeacher::class, 1);
        Mail::assertQueued(function (WelcomeTeacher $mail) use ($teacher) {
            return $mail->teacher->id === $teacher->id &&
                   $mail->hasTo($teacher->email) &&
                   $mail->hasTo($teacher->school_email);
        });
    }
}
