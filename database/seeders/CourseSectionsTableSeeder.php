<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class CourseSectionsTableSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();

        $this->createCourseSections();
    }

    /**
     * Create a course section for a course.
     *
     * @return \App\Models\CourseSection
     */
    protected function createCourseSections()
    {
        foreach (Course::all() as $course) {
            $this->createCourseSection($course);
        }
    }

    /**
     * Create a course section for a course.
     *
     * @param  \App\Models\Course $course
     * @return \App\Models\CourseSection
     */
    protected function createCourseSection(Course $course)
    {
        return CourseSection::factory()->create([
            'course_id' => $course->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'day' => $this->faker->randomElement(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
            'start_time' => $startTime = Carbon::parse($this->faker->time('H:00')),
            'end_time' => $startTime->copy()->addHour(),
        ]);
    }
}
