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

    /** @test */
    public function index_returns_a_view()
    {
        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.index'));

        $response->assertStatus(200);
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
        $this->withoutExceptionHandling();
        Mail::fake();
        $firstName = Str::lower($this->faker->firstName);
        $lastName = Str::lower($this->faker->lastName);

        $attributes = [
            'title' => $this->faker->optional(0.1)->title,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'suffix' => $this->faker->suffix,
            'email' => $this->faker->safeEmail,
            'phone' => '(123) 456-7890',
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip' => Str::substr($this->faker->postcode, 0, 5),
        ];

        $response = $this->actingAs(Administrator::factory()->create())->post(route('teachers.store'), $attributes);

        $response->assertRedirect(route('teachers.index'));

        $this->assertDatabaseHas('users', $attributes);
        $teacher = Teacher::first();
        Mail::assertQueued(function (WelcomeTeacher $mail) use ($teacher) {
            return $mail->teacher->id === $teacher->id &&
                   $mail->hasTo($teacher->email) &&
                   $mail->hasTo($teacher->school_email);
        });
        Mail::assertQueued(WelcomeTeacher::class, 1);
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(TeachersController::class, 'store', CreateTeacherRequest::class);
    }
}
