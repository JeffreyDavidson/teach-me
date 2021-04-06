<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemesterCourseSectionsList;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SemesterCourseSectionsListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(SemesterCourseSectionsList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(SemesterCourseSectionsList::class)
            ->assertViewHas('courseSections')
            ->assertViewIs('livewire.semesters.course-sections-list');
    }

    /** @test */
    public function returns_only_course_sections_specific_to_semester_course()
    {
        $course = Course::factory()->create();
        $semester = Semester::factory()
                    ->hasAttached(
                        $courseSectionOne = CourseSection::factory()->create(['course_id' => $course->id, 'day' => 'Tuesday', 'start_time' => '07:00']),
                        ['start_date' => now(), 'end_date' => now()->addDay()]
                    )
                    ->hasAttached(
                        $courseSectionTwo = CourseSection::factory()->create(['course_id' => $course->id, 'day' => 'Tuesday', 'start_time' => '10:00']),
                        ['start_date' => now(), 'end_date' => now()->addDay()]
                    )
                    ->create();

        $courseSectionTwo = CourseSection::factory()->create(['course_id' => $course->id, 'day' => 'Friday', 'start_time' => '09:00']);

        Livewire::test(SemesterCourseSectionsList::class, [
            'semester' => $semester,
            'course' => $course,
        ])
            ->assertSee($courseSectionOne->start_time)
            ->assertDontSee($courseSectionTwo->start_time);
    }

    /** @test */
    public function filters_courses_semester_sections_by_teacher_name()
    {
        $course = Course::factory()->create();
        $johnSmith = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $johnWilliams = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Williams']);
        $maryWilliams = Teacher::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);
        $semester = Semester::factory()
                    ->hasAttached(
                        CourseSection::factory()
                            ->create(['course_id' => $course->id, 'day' => 'Tuesday', 'teacher_id' => $johnSmith->id]),
                        ['start_date' => now(), 'end_date' => now()->addDay()]
                    )
                    ->hasAttached(
                        CourseSection::factory()
                            ->create(['course_id' => $course->id, 'day' => 'Tuesday', 'teacher_id' => $johnWilliams->id]),
                        ['start_date' => now(), 'end_date' => now()->addDay()]
                    )
                    ->hasAttached(
                        CourseSection::factory()
                            ->create(['course_id' => $course->id, 'day' => 'Tuesday', 'teacher_id' => $maryWilliams->id]),
                        ['start_date' => now(), 'end_date' => now()->addDay()]
                    )
                    ->create();

        Livewire::test(SemesterCourseSectionsList::class, [
            'semester' => $semester,
            'course' => $course,
        ])
            ->set('filters.search', 'John')
            ->assertSee($johnSmith->full_name)
            ->assertSee($johnWilliams->full_name)
            ->assertDontSee($maryWilliams->full_name);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(SemesterCourseSectionsList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(SemesterCourseSectionsList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
