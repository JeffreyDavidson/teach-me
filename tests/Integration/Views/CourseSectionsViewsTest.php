<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseSectionsViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function course_sections_index_uses_course_sections_list_livewire_component()
    {
        $course = Course::factory()->has(CourseSection::factory()->count(3), 'sections')->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.course-sections.index', $course))
            ->assertSeeLivewire('course-sections-list');
    }
}
