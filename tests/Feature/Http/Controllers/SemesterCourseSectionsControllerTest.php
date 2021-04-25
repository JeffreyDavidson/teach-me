<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Administrator;
use App\Models\CourseSectionSemester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SemesterCourseSectionsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_a_view()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSectionSemester->semester, $courseSectionSemester->courseSection->course]))
            ->assertSuccessful()
            ->assertViewHas('semester', $courseSectionSemester->semester)
            ->assertViewHas('course', $courseSectionSemester->courseSection->course)
            ->assertViewIs('semesters.course-sections');
    }

    /** @test */
    public function index_redirects_when_unauthenticated()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->get(route('semesters.courses.sections.index', [$courseSectionSemester->semester, $courseSectionSemester->courseSection->course]))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_list_of_semester_courses()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSectionSemester->semester, $courseSectionSemester->courseSection->course]))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_list_of_semester_courses()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.courses.sections.index', [$courseSectionSemester->semester, $courseSectionSemester->courseSection->course]))
            ->assertForbidden();
    }

    /** @test */
    public function show_returns_a_view()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.sections.show', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
                $courseSectionSemester->courseSection,
            ]))
            ->assertSuccessful()
            ->assertViewIs('semesters.course-section-details')
            ->assertViewHas('semester', $courseSectionSemester->semester)
            ->assertViewHas('course', $courseSectionSemester->courseSection->course)
            ->assertViewHas('section', $courseSectionSemester->section);
    }

    /** @test */
    public function show_redirects_when_unauthenticated()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->get(route('semesters.courses.sections.show', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
                $courseSectionSemester->courseSection,
            ]))
            ->assertRedirect();
    }

    /** @test */
    public function teachers_cannot_view_semester_course_section_details_page()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Teacher::factory()->create())
            ->get(route('semesters.courses.sections.show', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
                $courseSectionSemester->courseSection,
            ]))
            ->assertForbidden();
    }

    /** @test */
    public function students_cannot_view_semester_course_section_details_page()
    {
        $courseSectionSemester = CourseSectionSemester::factory()->create();

        $this
            ->actingAs(Student::factory()->create())
            ->get(route('semesters.courses.sections.show', [
                $courseSectionSemester->semester,
                $courseSectionSemester->courseSection->course,
                $courseSectionSemester->courseSection,
            ]))
            ->assertForbidden();
    }
}
