<?php

namespace Tests\Unit\Mail;

use App\Mail\WelcomeTeacher;
use App\Models\Teacher;
use Tests\TestCase;

class WelcomeTeacherTest extends TestCase
{
    /** @test */
    public function it_shows_teacher_name_in_subject()
    {
        $teacher = Teacher::factory()->make();

        $mailable = new WelcomeTeacher($teacher);

        $mailable->assertSeeInHtml($teacher->school_email);
    }
}
