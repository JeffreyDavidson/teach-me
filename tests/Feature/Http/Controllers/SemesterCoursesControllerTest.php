<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SemesterCoursesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_a_view()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.index', $semester))
            ->assertSuccessful()
            ->assertViewIs('semesters.courses');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $semester = Semester::factory()->create();

        $this
            ->get(route('semesters.courses.index', $semester))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.courses.index', $semester))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.courses.index', $semester))
            ->assertForbidden();
    }
}
