<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\CourseSection;
use App\Models\CourseSectionSemester;
use App\Models\CourseSemester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseSectionsViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function course_sections_index_uses_course_sections_list_livewire_component()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.index', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
            ]))
            ->assertSeeLivewire('semester-course-sections-list');
    }
}
