<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
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
            'course_id' => Course::factory(),
            'semester_id' => Semester::factory(),
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addMonths(3),
        ];
    }
}
