<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SemestersControllerTest extends TestCase
{
    use RefreshDatabase;

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
}
