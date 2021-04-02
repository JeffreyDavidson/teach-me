<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSemester;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseSection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_semester_id' => CourseSemester::factory(),
            'teacher_id' => Teacher::factory(),
            'start_time' => $startTime = Carbon::parse($this->faker->time('H:00')),
            'end_time' => $startTime->addHour(),
        ];
    }
}
