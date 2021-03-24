<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teachers_index_uses_teachers_list_livewire_component()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('teachers.index'))
            ->assertSeeLivewire('teachers-list');
    }
}
