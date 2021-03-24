<?php

namespace Tests\Integration\Views;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_display_the_correct_breadcrumbs()
    {
        $this->markTestIncomplete();
        $teacher = Teacher::factory()->create(['title' => 'Dr.', 'first_name' => 'Taylor', 'last_name' => 'Otwell']);

        $view = $this->view('teachers.show', ['teacher' => $teacher]);
    }

    /** @test */
    public function show_page_display_teachers_full_name()
    {
        $teacher = Teacher::factory()->create(['title' => 'Dr.', 'first_name' => 'Taylor', 'last_name' => 'Otwell']);

        $view = $this->view('teachers.show', ['teacher' => $teacher]);

        $view->assertSee('Dr. Taylor Otwell');
    }

    /** @test */
    public function show_page_displays_teachers_role()
    {
        $teacher = Teacher::factory()->create();

        $view = $this->view('teachers.show', ['teacher' => $teacher]);

        $view->assertSee('Teacher');
    }
}
