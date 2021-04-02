<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\CourseSemester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SemesterCourseSectionsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_a_view()
    {
        $courseSemester = CourseSemester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSemester->semester, $courseSemester->course]))
            ->assertSuccessful()
            ->assertViewHas('semester', $courseSemester->semester)
            ->assertViewHas('course', $courseSemester->course)
            ->assertViewIs('semesters.course-sections');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $courseSemester = CourseSemester::factory()->create();

        $this
            ->get(route('semesters.courses.sections.index', [$courseSemester->semester, $courseSemester->course]))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_semester_courses()
    {
        $courseSemester = CourseSemester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSemester->semester, $courseSemester->course]))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_semester_courses()
    {
        $courseSemester = CourseSemester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSemester->semester, $courseSemester->course]))
            ->assertForbidden();
    }
}
