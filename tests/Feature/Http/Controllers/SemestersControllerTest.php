<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\SemestersController;
use App\Http\Requests\CreateSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Models\Administrator;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class SemestersControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, AdditionalAssertions;

    private $attributes;

    private $courses;

    protected function setUp(): void
    {
        parent::setUp();

        $date = Carbon::parse('January 1, 2020');
        $this->courses = Course::factory()->count(2)->create();

        $this->attributes = [
            'term' => 'Fall',
            'year' => $date->year,
            'start_date' => $date->toDateString(),
            'end_date' => $date->addMonths(3)->toDateString(),
            'courses' => $this->courses->pluck('id')->toArray(),
        ];
    }

    /** @test */
    public function index_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.index'))
            ->assertSuccessful()
            ->assertViewIs('semesters.index');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $this
            ->get(route('semesters.index'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_semesters()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.index'))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_semesters()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.index'))
            ->assertForbidden();
    }

    /** @test */
    public function create_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.create'))
            ->assertSuccessful()
            ->assertViewIs('semesters.create')
            ->assertViewHas('semester');
    }

    /** @test */
    public function create_redirects_when_unauthenticated()
    {
        $this
            ->get(route('semesters.create'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_create_semester_page()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.create'))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_create_semester_page()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.create'))
            ->assertForbidden();
    }

    /** @test */
    public function store_creates_a_semester_and_redirects()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('semesters.store'), [
                'term' => 'Fall',
                'year' => 2021,
                'start_date' => '2021-08-04',
                'end_date' => '2022-01-03',
                'courses' => $this->courses->pluck('id')->toArray(),
            ])
            ->assertRedirect(route('semesters.index'));

        $this->assertDatabaseHas('semesters', ['name' => 'Fall 2021', 'start_date' => Carbon::parse('2021-08-04')->toDateTimeString(), 'end_date' => Carbon::parse('2022-01-03')->toDateTimeString()]);
    }

    /** @test */
    public function teachers_cannot_create_semesters()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->post(route('semesters.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_create_semesters()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->post(route('semesters.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function store_redirects_when_unauthenticated()
    {
        $this
            ->post(route('semesters.store'), $this->attributes)
            ->assertRedirect();
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(SemestersController::class, 'store', CreateSemesterRequest::class);
    }

    /** @test */
    public function edit_returns_a_view()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.edit', $semester))
            ->assertSuccessful()
            ->assertViewIs('semesters.edit')
            ->assertViewHas('semester', $semester);
    }

    /** @test */
    public function edit_redirects_when_unauthenticated()
    {
        $semester = Semester::factory()->create();

        $this
            ->get(route('semesters.edit', $semester))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_edit_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.edit', $semester))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_edit_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.edit', $semester))
            ->assertForbidden();
    }

    /** @test */
    public function update_updates_a_semester_and_redirects()
    {
        $semester = Semester::factory()->create([
            'name' => 'Fall '.now()->addYear()->year,
            'start_date' => now()->copy()->addYear()->toDateString(),
            'end_date' => now()->copy()->addMonths(3)->addYear()->toDateString(),
        ]);

        $newStartDate = Carbon::parse($semester->start_date)->addMonth();
        $newEndDate = Carbon::parse($semester->end_date)->addMonth();

        $this
            ->actingAs(Administrator::factory()->create())
            ->patch(route('semesters.update', $semester), [
                'term' => 'Fall',
                'year' => $newYear = Carbon::parse($semester->year)->addYear()->year,
                'start_date' => $newStartDate->toDateString(),
                'end_date' => $newEndDate->toDateString(),
                'courses' => $this->courses->pluck('id')->toArray(),
            ])
            ->assertRedirect(route('semesters.index'));

        $this->assertDatabaseHas('semesters', ['name' => 'Fall '.$newYear, 'start_date' => $newStartDate->toDateTimeString(), 'end_date' => $newEndDate->toDateTimeString()]);
    }

    /** @test */
    public function teachers_cannot_update_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->patch(route('semesters.update', $semester), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_update_semesters()
    {
        $semester = Semester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->patch(route('semesters.update', $semester), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function update_redirects_when_unauthenticated()
    {
        $semester = Semester::factory()->create();

        $this
            ->patch(route('semesters.update', $semester), $this->attributes)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function update_uses_form_request()
    {
        $this->assertActionUsesFormRequest(SemestersController::class, 'update', UpdateSemesterRequest::class);
    }
}
