<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeachersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_a_view()
    {
        $response = $this->actingAs(Administrator::factory()->create())->get(route('teachers.index'));

        $response->assertStatus(200);
        $response->assertViewIs('teachers.index');
        $response->assertSeeLivewire('teachers-list');
    }
}
