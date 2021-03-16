<?php

namespace Tests\Integration;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teachers_index_uses_teachers_list_livewire_component()
    {
        $response = $this->actingAs(Administrator::factory()->create())->get('teachers.index');

        $response->assertSeeLivewire('teachers-list');
    }
}
