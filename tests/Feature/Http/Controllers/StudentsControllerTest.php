<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\StudentCreated;
use App\Http\Controllers\StudentsController;
use App\Http\Requests\CreateStudentRequest;
use App\Mail\WelcomeStudent;
use App\Models\Administrator;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
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
        $response = $this->actingAs(Administrator::factory()->create())->get(route('students.index'));

        $response->assertSuccessful();
        $response->assertViewIs('students.index');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $response = $this->get(route('students.index'));

        $response->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_students()
    {
        $response = $this->actingAs(Teacher::factory()->create())->get(route('students.index'));

        $response->assertForbidden();
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
        $this->actingAs(Teacher::factory()->create())
            ->get(route('students.create'), $this->attributes)
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_create_student_page()
    {
        $this->actingAs(Student::factory()->create())
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
    public function store_queues_welcome_student_email()
    {
        Mail::fake();

        $this
            ->actingAs(Administrator::factory()->create())
            ->post(route('students.store'), $this->attributes);

        $student = Student::first();

        Mail::assertQueued(WelcomeStudent::class, 1);
        Mail::assertQueued(function (WelcomeStudent $mail) use ($student) {
            return $mail->student->id === $student->id &&
                   $mail->hasTo($student->email) &&
                   $mail->hasTo($student->school_email);
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
}
