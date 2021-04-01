<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemesterCourseList;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SemesterCourseListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(SemesterCourseList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(SemesterCourseList::class)
            ->assertViewHas('courses')
            ->assertViewIs('livewire.semesters.course-list');
    }

    /** @test */
    public function returns_only_courses_for_specific_semester()
    {
        $semester = Semester::factory()->create();
        $semesterCourse = Course::factory()->hasAttached($semester, ['start_date' => now(), 'end_date' => now()])->create();
        $otherCourse = Course::factory()->create();

        Livewire::test(SemesterCourseList::class, ['semester' => $semester])
            ->assertSee($semesterCourse->name)
            ->assertDontSee($otherCourse->name);
    }

    /** @test */
    public function filters_semester_courses_by_name()
    {
        $semester = Semester::factory()->create();
        $chemistry101Course = Course::factory()->hasAttached($semester, ['start_date' => now(), 'end_date' => now()])->create(['name' => 'Chemistry 101']);
        $chemistry102Course = Course::factory()->hasAttached($semester, ['start_date' => now(), 'end_date' => now()])->create(['name' => 'Chemistry 102']);
        $lawCourse = Course::factory()->hasAttached($semester, ['start_date' => now(), 'end_date' => now()])->create(['name' => 'Law']);

        Livewire::test(SemesterCourseList::class, ['semester' => $semester])
            ->set('filters.search', 'Chemistry')
            ->assertSee($chemistry101Course->name)
            ->assertSee($chemistry102Course->name)
            ->assertDontSee($lawCourse->name);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(SemesterCourseList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(SemesterCourseList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
