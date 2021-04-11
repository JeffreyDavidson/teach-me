<?php

namespace Tests\Integration\Http\Livewire;

use App\Http\Livewire\CreateSemesterCourses;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateSemesterCoursesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function properties_are_set_by_default_when_component_is_rendered()
    {
        $semester = Semester::factory()->create();

        Livewire::test(CreateSemesterCourses::class, ['semester' => $semester])
            ->assertSet('semester', $semester)
            ->assertSet('courses', Course::allForDropdown()->toArray());
    }

    /** @test */
    public function renders_correct_view()
    {
        Livewire::test(CreateSemesterCourses::class)
            ->assertViewHas('semesters')
            ->assertViewHas('semester')
            ->assertViewHas('courses')
            ->assertViewIs('livewire.semesters.create-semester-courses');
    }

    /** @test */
    public function updates_selected_courses_based_off_semester_to_duplicate()
    {
        $semesterToDuplicate = Semester::factory()
                                    ->hasAttached(CourseSection::factory(), ['start_date' => now(), 'end_date' => now()], 'courseSections')
                                    ->hasAttached(CourseSection::factory(), ['start_date' => now(), 'end_date' => now()], 'courseSections')
                                    ->create();

        $duplicatedSemesterCourses = $semesterToDuplicate->courseSections->map(function ($section) {
            return $section->course;
        });

        Livewire::test(CreateSemesterCourses::class)
            ->set('semesterIdToDuplicate', $semesterToDuplicate->id)
            ->assertSet('selectedCourses', $duplicatedSemesterCourses->pluck('id')->toArray())
            ->set('semesterIdToDuplicate', 0)
            ->assertSet('selectedCourses', []);
    }
}
