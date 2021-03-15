<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\TeachersController;
use App\Http\Requests\CreateTeacherRequest;
use App\Mail\WelcomeTeacher;
use App\Models\Administrator;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class TeachersControllerTest extends TestCase
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
        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.index'));

        $response->assertSuccessful();
        $response->assertViewIs('teachers.index');
    }

    /** @test */
    public function create_returns_a_view()
    {
        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.create'));

        $response->assertStatus(200);
        $response->assertViewIs('teachers.create');
    }

    /** @test */
    public function store_creates_a_teacher_and_redirects()
    {
        $response = $this->actingAs(Administrator::factory()->create())->post(route('teachers.store'), $this->attributes);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('users', array_merge($this->attributes, ['phone' => '1234567890', 'role' => 'teacher']));
    }

    /** @test */
    public function store_queues_welcome_teacher_email()
    {
        Mail::fake();

        $this->actingAs(Administrator::factory()->create())->post(route('teachers.store'), $this->attributes);

        $teacher = Teacher::first();

        Mail::assertQueued(WelcomeTeacher::class, 1);
        Mail::assertQueued(function (WelcomeTeacher $mail) use ($teacher) {
            return $mail->teacher->id === $teacher->id &&
                   $mail->hasTo($teacher->email) &&
                   $mail->hasTo($teacher->school_email);
        });
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(TeachersController::class, 'store', CreateTeacherRequest::class);
    }
}
