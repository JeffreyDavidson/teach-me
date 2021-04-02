<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemesterCourseSectionsList;
use App\Models\CourseSection;
use App\Models\CourseSemester;
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
    public function returns_only_courses_sections_specific_to_semester_course()
    {
        $courseSemester = CourseSemester::factory()->create();
        $courseSectionOne = CourseSection::factory()->create(['course_semester_id' => $courseSemester->id, 'start_time' => '07:00']);
        $courseSectionTwo = CourseSection::factory()->create(['start_time' => '08:00']);

        Livewire::test(SemesterCourseSectionsList::class, [
            'semester' => $courseSemester->semester,
            'course' => $courseSemester->course,
        ])
            ->assertSee($courseSectionOne->start_time)
            ->assertDontSee($courseSectionTwo->start_time);
    }

    /** @test */
    public function filters_courses_sections_by_teacher_name()
    {
        $courseSemester = CourseSemester::factory()->create();
        $johnSmith = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $johnWilliams = Teacher::factory()->create(['first_name' => 'John', 'last_name' => 'Williams']);
        $maryWilliams = Teacher::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);
        CourseSection::factory()->create(['course_semester_id' => $courseSemester->id, 'teacher_id' => $johnSmith->id]);
        CourseSection::factory()->create(['course_semester_id' => $courseSemester->id, 'teacher_id' => $johnWilliams->id]);
        CourseSection::factory()->create(['course_semester_id' => $courseSemester->id, 'teacher_id' => $maryWilliams->id]);

        Livewire::test(SemesterCourseSectionsList::class, [
            'semester' => $courseSemester->semester,
            'course' => $courseSemester->course,
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
