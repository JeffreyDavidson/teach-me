<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemesterCourseList;
use App\Models\Course;
use App\Models\CourseSection;
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
    public function returns_only_courses_taken_for_specific_semester()
    {
        $philosophy = Course::factory()->create(['name' => 'Philosophy']);
        $history = Course::factory()->create(['name' => 'History']);
        $science = Course::factory()->create(['name' => 'Science']);

        $courseSectionOne = CourseSection::factory()->create(['course_id' => $philosophy->id]);
        $courseSectionTwo = CourseSection::factory()->create(['course_id' => $history->id]);

        $semester = Semester::factory()
                        ->hasAttached($courseSectionOne, ['start_date' => now(), 'end_date' => now()->addDay()])
                        ->hasAttached($courseSectionTwo, ['start_date' => now(), 'end_date' => now()->addDay()])
                        ->create();

        Livewire::test(SemesterCourseList::class, [
            'semester' => $semester,
        ])
            ->assertSee($philosophy->name)
            ->assertSee($history->name)
            ->assertDontSee($science->name);
    }

    /** @test */
    public function filters_courses_sections_by_course_name()
    {
        $philosophy101 = Course::factory()->create(['name' => 'Philosophy 101']);
        $philosophy102 = Course::factory()->create(['name' => 'Philosophy 102']);
        $science = Course::factory()->create(['name' => 'Science']);

        $courseSectionOne = CourseSection::factory()->create(['course_id' => $philosophy101->id]);
        $courseSectionTwo = CourseSection::factory()->create(['course_id' => $philosophy102->id]);

        $semester = Semester::factory()
                        ->hasAttached($courseSectionOne, ['start_date' => now(), 'end_date' => now()->addDay()])
                        ->hasAttached($courseSectionTwo, ['start_date' => now(), 'end_date' => now()->addDay()])
                        ->create();

        Livewire::test(SemesterCourseList::class, [
            'semester' => $semester,
        ])
            ->set('filters.search', 'Philosophy')
            ->assertSee($philosophy101->name)
            ->assertSee($philosophy101->name)
            ->assertDontSee($science->name);
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
    public function resetting_filters_make_keys_reset_to_default()
    {
        Livewire::test(SemesterCourseList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
