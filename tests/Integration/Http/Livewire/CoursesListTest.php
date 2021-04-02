<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\CoursesList;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CoursesListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(CoursesList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(CoursesList::class)
            ->assertViewHas('courses')
            ->assertViewIs('livewire.courses.courses-list');
    }

    /** @test */
    public function returns_list_of_courses()
    {
        $chemistry = Course::factory()->create(['name' => 'Chemistry']);
        $law = Course::factory()->create(['name' => 'Law']);

        Livewire::test(CoursesList::class)
            ->assertSee($chemistry->name)
            ->assertSee($law->name);
    }

    /** @test */
    public function filters_courses_by_name()
    {
        $chemistry = Course::factory()->create(['name' => 'Chemistry']);
        $law = Course::factory()->create(['name' => 'Law']);

        Livewire::test(CoursesList::class)
            ->set('filters.search', 'Chemistry')
            ->assertSee($chemistry->name)
            ->assertDontSee($law->name);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(CoursesList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(CoursesList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
