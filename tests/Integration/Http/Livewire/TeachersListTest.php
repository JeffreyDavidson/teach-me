<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\TeachersList;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TeachersListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(TeachersList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(TeachersList::class)
            ->assertViewHas('teachers')
            ->assertViewIs('livewire.teachers.teachers-list');
    }

    /** @test */
    public function returns_list_of_teachers()
    {
        $johnSmith = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $maryWilliams = Teacher::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);

        Livewire::test(TeachersList::class)
            ->assertSee($johnSmith->full_name_listing)
            ->assertSee($maryWilliams->full_name_listing);
    }

    /** @test */
    public function filters_teachers_by_name()
    {
        $johnSmith = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $johnWilliams = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Williams']);
        $maryWilliams = Teacher::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);

        Livewire::test(TeachersList::class)
            ->set('filters.search', 'John')
            ->assertSee($johnSmith->full_name_listing)
            ->assertSee($johnWilliams->full_name_listing)
            ->assertDontSee($maryWilliams->full_name_listing);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(TeachersList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(TeachersList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
