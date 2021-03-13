<?php

namespace Tests\Unit\Mail;

use App\Mail\WelcomeTeacher;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTeacherTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_teacher_name_in_subject()
    {
        $teacher = Teacher::factory()->create();

        $mailable = new WelcomeTeacher($teacher);

        $mailable->assertSeeInHtml($teacher->school_email);
    }
}
