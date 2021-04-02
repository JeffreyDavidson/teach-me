<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemestersList;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SemestersListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(SemestersList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(SemestersList::class)
            ->assertViewHas('semesters')
            ->assertViewIs('livewire.semesters.semesters-list');
    }

    /** @test */
    public function returns_list_of_semesters()
    {
        $fall2021 = Semester::factory()->create(['name' => 'Fall 2021']);
        $summer2021 = Semester::factory()->create(['name' => 'Summer 2021']);

        Livewire::test(SemestersList::class)
            ->assertSee($fall2021->name)
            ->assertSee($summer2021->name);
    }

    /** @test */
    public function filters_semesters_by_name()
    {
        $fall2020 = Semester::factory()->create(['name' => 'Fall 2020']);
        $fall2021 = Semester::factory()->create(['name' => 'Fall 2021']);
        $summer2021 = Semester::factory()->create(['name' => 'Summer 2021']);

        Livewire::test(SemestersList::class)
            ->set('filters.search', 'Fall')
            ->assertSee($fall2020->name)
            ->assertSee($fall2021->name)
            ->assertDontSee($summer2021->name);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(SemestersList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(SemestersList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
