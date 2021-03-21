<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class StudentsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, AdditionalAssertions;

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
}
