<?php

namespace Tests\Integration\Views;

use App\Models\Administrator;
use App\Models\Course;
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
    public function semester_courses_uses_semesters_course_list_livewire_component()
    {
        $semester = Semester::factory()
                            ->hasAttached(Course::factory()->count(3), ['start_date' => now(), 'end_date' => now()])
                            ->create();

        $this
            ->actingAs(Administrator::factory()->create())
            ->get(route('semesters.courses.index', $semester))
            ->assertSeeLivewire('semester-course-list');
    }
}
