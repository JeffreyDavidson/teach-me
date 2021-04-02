<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\SemesterCourseSectionStudentList;
use App\Models\CourseSection;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SemesterCourseSectionStudentListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        Livewire::test(SemesterCourseSectionStudentList::class)
            ->assertSet('showFilters', false)
            ->assertSet('filters.search', '');
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(SemesterCourseSectionStudentList::class)
            ->assertViewHas('students')
            ->assertViewIs('livewire.semesters.course-section-student-list');
    }

    /** @test */
    public function returns_only_students_specific_to_course_section()
    {
        $courseSection = CourseSection::factory()->create();
        $johnSmith = Student::factory()->hasAttached($courseSection)->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $johnWilliams = Student::factory()->hasAttached($courseSection)->create(['first_name' => 'John', 'last_name' => 'Williams']);
        $maryWilliams = Student::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);

        Livewire::test(SemesterCourseSectionStudentList::class, [
            'section' => $courseSection,
        ])
            ->assertSee($johnSmith->full_name_listing)
            ->assertSee($johnWilliams->full_name_listing)
            ->assertDontSee($maryWilliams->full_name_listing);
    }

    /** @test */
    public function filters_students_by_name()
    {
        $courseSection = CourseSection::factory()->create();
        $johnSmith = Student::factory()->hasAttached($courseSection)->create(['first_name' => 'John', 'last_name' => 'Smith']);
        $johnWilliams = Student::factory()->hasAttached($courseSection)->create(['first_name' => 'John', 'last_name' => 'Williams']);
        $maryWilliams = Student::factory()->create(['first_name' => 'Mary', 'last_name' => 'Williams']);

        Livewire::test(SemesterCourseSectionStudentList::class, [
            'section' => $courseSection,
        ])
            ->set('filters.search', 'John')
            ->assertSee($johnSmith->full_name_listing)
            ->assertSee($johnWilliams->full_name_listing)
            ->assertDontSee($maryWilliams->full_name_listing);
    }

    /** @test */
    public function show_filters_will_toggle_visibility()
    {
        Livewire::test(SemesterCourseSectionStudentList::class)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', true)
                 ->call('toggleShowFilters')
                 ->assertSet('showFilters', false);
    }

    /** @test */
    public function restting_filters_make_keys_reset_to_default()
    {
        Livewire::test(SemesterCourseSectionStudentList::class)
                 ->set('filters.search', 'TestFilter')
                 ->call('resetFilters')
                 ->assertSet('filters.search', '');
    }
}
