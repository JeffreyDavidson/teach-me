<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SemestersViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function semesters_index_uses_semesters_list_livewire_component()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.index'))
            ->assertSeeLivewire('semesters-list');
    }
}
