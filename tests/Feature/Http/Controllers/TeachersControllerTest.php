<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\TeachersController;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Administrator;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
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
    public function index_redirects_when_unauthenticated()
    {
        $response = $this->get(route('teachers.index'));

        $response->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_teachers()
    {
        $response = $this->actingAs(Teacher::factory()->create())->get(route('teachers.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function create_returns_a_view()
    {
        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.create'));

        $response->assertSuccessful();
        $response->assertViewIs('teachers.create');
    }

    /** @test */
    public function create_redirects_when_unauthenticated()
    {
        $response = $this->get(route('teachers.create'));

        $response->assertRedirect();
    }

    /** @test */
    public function store_creates_a_teacher_and_redirects()
    {
        $response = $this->actingAs(Administrator::factory()->create())->post(route('teachers.store'), $this->attributes);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('users', array_merge($this->attributes, ['phone' => '1234567890', 'role' => 'teacher']));
    }

    /** @test */
    public function store_generates_a_school_email_for_created_teacher()
    {
        $this->attributes = data_set($this->attributes, 'first_name', 'John');
        $this->attributes = data_set($this->attributes, 'last_name', 'Smith');
        Config::set('school.domain', 'example.com');

        $response = $this->actingAs(Administrator::factory()->create())->post(route('teachers.store'), $this->attributes);

        $this->assertEquals('john.smith@example.com', Teacher::first()->school_email);
    }

    /** @test */
    public function teachers_cannot_create_other_teachers()
    {
        $response = $this->actingAs(Teacher::factory()->create())->post(route('teachers.store'), $this->attributes);

        $response->assertForbidden();
    }

    /** @test */
    public function store_redirects_when_unauthenticated()
    {
        $response = $this->post(route('teachers.store'), $this->attributes);

        $response->assertRedirect();
    }

    /** @test */
    public function store_uses_form_request()
    {
        $this->assertActionUsesFormRequest(TeachersController::class, 'store', CreateTeacherRequest::class);
    }

    /** @test */
    public function edit_returns_a_view()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.edit', $teacher));

        $response->assertSuccessful();
        $response->assertViewIs('teachers.edit');
        $response->assertViewHas('teacher', $teacher);
    }

    /** @test */
    public function edit_redirects_when_unauthenticated()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teachers.edit', $teacher));

        $response->assertRedirect();
    }

    /** @test */
    public function edit_redirects_when_unauthorized()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Teacher::factory()->create())->get(route('teachers.edit', $teacher));

        $response->assertForbidden();
    }

    /** @test */
    public function update_updates_a_teacher_and_redirects()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Administrator::factory()->create())->patch(route('teachers.update', $teacher), $this->attributes);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('users', array_merge($this->attributes, ['phone' => '1234567890', 'role' => 'teacher']));
    }

    /** @test */
    public function teachers_cannot_update_other_teachers()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Teacher::factory()->create())->patch(route('teachers.update', $teacher), $this->attributes);

        $response->assertForbidden();
    }

    /** @test */
    public function update_redirects_when_unauthenticated()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->patch(route('teachers.update', $teacher), $this->attributes);

        $response->assertRedirect();
    }

    /** @test */
    public function update_uses_form_request()
    {
        $this->assertActionUsesFormRequest(TeachersController::class, 'update', UpdateTeacherRequest::class);
    }

    /** @test */
    public function show_returns_a_view()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.show', $teacher));

        $response->assertSuccessful();
        $response->assertViewIs('teachers.show');
        $response->assertViewHas('teacher', $teacher);
    }

    /** @test */
    public function show_redirects_when_unauthenticated()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teachers.show', $teacher));

        $response->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_teacher_details_page()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->actingAs(Teacher::factory()->create())->get(route('teachers.show', $teacher));

        $response->assertForbidden();
    }
}
