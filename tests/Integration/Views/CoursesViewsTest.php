<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursesViewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function courses_index_uses_courses_list_livewire_component()
    {
        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.index'))
            ->assertSeeLivewire('courses-list');
    }

    /** @test */
    public function course_show_uses_course_sections_list_livewire_component()
    {
        $course = Course::factory()->has(CourseSection::factory()->count(3), 'sections')->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('courses.show', $course))
            ->assertSeeLivewire('course-sections-list');
    }
}
