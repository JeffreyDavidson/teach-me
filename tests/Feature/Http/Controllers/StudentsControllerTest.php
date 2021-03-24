<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\StudentCreated;
use App\Http\Controllers\StudentsController;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Administrator;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class StudentsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, AdditionalAssertions;

    private $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = [
            'title' => $this->faker->optional(0.1)->title,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->suffix,
            'email' => $this->faker->safeEmail,
            'phone' => '(123) 456-7890',
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip' => Str::substr($this->faker->postcode, 0, 5),
        ];
    }

    /** @test */
    public function index_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('students.index'))
            ->assertSuccessful()
            ->assertViewIs('students.index');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $this
            ->get(route('students.index'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_students()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('students.index'))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_students()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('students.index'))
            ->assertForbidden();
    }

    /** @test */
    public function create_returns_a_view()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('students.create'))
            ->assertSuccessful()
            ->assertViewIs('students.create');
    }

    /** @test */
    public function create_redirects_when_unauthenticated()
    {
        $this
            ->get(route('students.create'))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_create_student_page()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('students.create'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_create_student_page()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->get(route('students.create'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function store_creates_a_student_and_redirects()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('students.store'), $this->attributes)
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('users', array_merge($this->attributes, ['phone' => '1234567890', 'role' => 'student']));
    }

    /** @test */
    public function store_generates_a_school_email_for_created_student()
    {
        $this->attributes = data_set($this->attributes, 'first_name', 'John');
        $this->attributes = data_set($this->attributes, 'last_name', 'Smith');
        Config::set('school.domain', 'example.com');

        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('students.store'), $this->attributes);

        $this->assertEquals('john.smith@example.com', Student::first()->school_email);
    }

    /** @test */
    public function store_dispatches_student_created_event()
    {
        Event::fake();

        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('students.store'), $this->attributes);

        Event::assertDispatched(function (StudentCreated $job) {
            return $job->student->id === Student::first()->id;
        });
    }

    /** @test */
    public function teachers_cannot_create_students()
    {
        $this
            ->actingAs(Teacher::factory()->create())
            ->post(route('students.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_create_other_students()
    {
        $this
            ->actingAs(Student::factory()->create())
            ->post(route('students.store'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function store_redirects_when_unauthenticated()
    {
        $this
            ->post(route('students.store'), $this->attributes)
            ->assertRedirect();
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(StudentsController::class, 'store', CreateStudentRequest::class);
    }

    /** @test */
    public function edit_returns_a_view()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('students.edit', $student))
            ->assertSuccessful()
            ->assertViewIs('students.edit')
            ->assertViewHas('student', $student);
    }

    /** @test */
    public function edit_redirects_when_unauthenticated()
    {
        $student = Student::factory()->create();

        $this
            ->get(route('students.edit', $student))
            ->assertRedirect();
    }

    /** @test */
    public function students_cannot_edit_other_students()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('students.edit', $student))
            ->assertForbidden();
    }

    /** @test */
    public function teachers_cannot_edit_students()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('students.edit', $student))
            ->assertForbidden();
    }

    /** @test */
    public function update_updates_a_student_and_redirects()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->patch(route('students.update', $student), $this->attributes)
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('users', array_merge($this->attributes, ['phone' => '1234567890', 'role' => 'student']));
    }

    /** @test */
    public function teachers_cannot_update_students()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->patch(route('students.update', $student), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_update_other_students()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->patch(route('students.update', $student), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function update_redirects_when_unauthenticated()
    {
        $student = Student::factory()->create();

        $this
            ->patch(route('students.update', $student), $this->attributes)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function update_uses_form_request()
    {
        $this->assertActionUsesFormRequest(StudentsController::class, 'update', UpdateStudentRequest::class);
    }

    /** @test */
    public function show_returns_a_view()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('students.show', $student))
            ->assertSuccessful()
            ->assertViewIs('students.show')
            ->assertViewHas('student', $student);
    }

    /** @test */
    public function show_redirects_when_unauthenticated()
    {
        $student = Student::factory()->create();

        $this
            ->get(route('students.show', $student))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_student_details_page()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('students.show', $student))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_students_details_page()
    {
        $student = Student::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('teachers.show', $student))
            ->assertForbidden();
    }
}
