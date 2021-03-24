<?php

namespace Tests\Unit\Mail;

use App\Mail\WelcomeStudent;
use App\Models\Student;
use Tests\TestCase;

class WelcomeStudentTest extends TestCase
{
    /** @test */
    public function it_shows_student_name_in_subject()
    {
        $student = Student::factory()->make();

        $mailable = new WelcomeStudent($student);

        $mailable->assertSeeInHtml($student->school_email);
    }
}
