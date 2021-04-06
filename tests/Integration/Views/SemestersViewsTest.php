<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSectionSemester;
use App\Models\Semester;
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

    /** @test */
    public function semester_course_section_student_list_uses_semester_course_section_student_list_livewire_component()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.show', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
                $courseSectionSemester->courseSection,
            ]))
            ->assertSeeLivewire('semester-course-section-student-list');
    }
}
