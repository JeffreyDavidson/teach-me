<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursesViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function courses_index_uses_courses_list_livewire_component()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.index'))
            ->assertSeeLivewire('courses-list');
    }
}
