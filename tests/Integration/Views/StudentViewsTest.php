<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function students_index_uses_students_list_livewire_component()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('students.index'))
            ->assertSeeLivewire('students-list');
    }
}
