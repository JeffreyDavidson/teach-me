<?php

namespace Tests\Integration\Listeners;

use App\Events\StudentCreated;
use App\Listeners\SendStudentWelcomeEmail;
use App\Mail\WelcomeStudent;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendStudentWelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function welcome_email_is_sent_when_student_is_created()
    {
        Mail::fake();

        $student = Student::factory()->create();

        (new SendStudentWelcomeEmail)->handle(new StudentCreated($student));

        Mail::assertQueued(WelcomeStudent::class, 1);
        Mail::assertQueued(function (WelcomeStudent $mail) use ($student) {
            return $mail->student->id === $student->id &&
                   $mail->hasTo($student->email) &&
                   $mail->hasTo($student->school_email);
        });
    }
}
