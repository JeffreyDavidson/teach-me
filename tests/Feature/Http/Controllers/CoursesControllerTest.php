<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CoursesController;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Administrator;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class CoursesControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, AdditionalAssertions;

    private $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = [
            'name' => $this->faker->unique()->words(5, true),
            'description' => $this->faker->paragraph,
        ];
    }

    /** @test */
    public function index_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.index'))
            ->assertSuccessful()
            ->assertViewIs('courses.index');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $this
            ->get(route('courses.index'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_courses()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('courses.index'))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_courses()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('courses.index'))
            ->assertForbidden();
    }

    /** @test */
    public function create_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.create'))
            ->assertSuccessful()
            ->assertViewIs('courses.create');
    }

    /** @test */
    public function create_redirects_when_unauthenticated()
    {
        $this
            ->get(route('courses.create'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_create_course_page()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('courses.create'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_create_course_page()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('courses.create'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function store_creates_a_course_and_redirects()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('courses.store'), $this->attributes)
            ->assertRedirect(route('courses.index'));

        $this->assertDatabaseHas('courses', $this->attributes);
    }

    /** @test */
    public function teachers_cannot_create_courses()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->post(route('courses.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_create_courses()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->post(route('courses.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function store_redirects_when_unauthenticated()
    {
        $this
            ->post(route('courses.store'), $this->attributes)
            ->assertRedirect();
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(CoursesController::class, 'store', CreateCourseRequest::class);
    }

    /** @test */
    public function edit_returns_a_view()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.edit', $course))
            ->assertSuccessful()
            ->assertViewIs('courses.edit')
            ->assertViewHas('course', $course);
    }

    /** @test */
    public function edit_redirects_when_unauthenticated()
    {
        $course = Course::factory()->create();

        $this
            ->get(route('students.edit', $course))
            ->assertRedirect();
    }

    /** @test */
    public function students_cannot_edit_courses()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('courses.edit', $course))
            ->assertForbidden();
    }

    /** @test */
    public function teachers_cannot_edit_courses()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('courses.edit', $course))
            ->assertForbidden();
    }

    /** @test */
    public function update_updates_a_course_and_redirects()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->patch(route('courses.update', $course), $this->attributes)
            ->assertRedirect(route('courses.index'));

        $this->assertDatabaseHas('courses', $this->attributes);
    }

    /** @test */
    public function teachers_cannot_update_courses()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->patch(route('courses.update', $course), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_update_courses()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->patch(route('courses.update', $course), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function update_redirects_when_unauthenticated()
    {
        $course = Course::factory()->create();

        $this
            ->patch(route('courses.update', $course), $this->attributes)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function update_uses_form_request()
    {
        $this->assertActionUsesFormRequest(CoursesController::class, 'update', UpdateCourseRequest::class);
    }

    /** @test */
    public function show_returns_a_view()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.show', $course))
            ->assertSuccessful()
            ->assertViewIs('courses.show')
            ->assertViewHas('course', $course);
    }

    /** @test */
    public function show_redirects_when_unauthenticated()
    {
        $course = Course::factory()->create();

        $this
            ->get(route('courses.show', $course))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_course_details_page()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('courses.show', $course))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_course_details_page()
    {
        $course = Course::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('courses.show', $course))
            ->assertForbidden();
    }
}
