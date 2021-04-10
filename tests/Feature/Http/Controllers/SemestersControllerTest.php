<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\SemestersController;
use App\Http\Requests\CreateSemesterRequest;
use App\Models\Administrator;
use App\Models\Course;
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

        $this->assertDatabaseHas('semesters', ['name' => 'Fall 2021', 'start_date' => '2021-08-04', 'end_date' => '2022-01-03']);
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
}
