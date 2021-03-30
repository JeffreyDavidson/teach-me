<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassSectionsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_a_view()
    {
        $sections = CourseSection::factory()->count(3)
                                ->for($course = Course::factory()->create())
                                ->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.course-sections.index', $course))
            ->assertSuccessful()
            ->assertViewIs('course-sections.index');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $course = Course::factory()->has(CourseSection::factory()->count(3), 'sections')->create();

        $this
            ->get(route('courses.course-sections.index', $course))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_course_sections()
    {
        $course = Course::factory()->has(CourseSection::factory()->count(3), 'sections')->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('courses.course-sections.index', $course))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_course_sections()
    {
        $course = Course::factory()->has(CourseSection::factory()->count(3), 'sections')->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('courses.course-sections.index', $course))
            ->assertForbidden();
    }
}
