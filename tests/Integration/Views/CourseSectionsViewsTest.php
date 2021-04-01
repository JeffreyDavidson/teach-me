<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSemester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseSectionsViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function course_sections_index_uses_course_sections_list_livewire_component()
    {
        $courseSemester = CourseSemester::factory()->create();
        CourseSection::factory()->count(3)->create(['course_semester_id' => $courseSemester->id]);

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSemester->semester, $courseSemester->course]))
            ->assertSeeLivewire('semester-course-sections-list');
    }
}
