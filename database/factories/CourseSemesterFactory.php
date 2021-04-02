<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSemester;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseSemesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseSemester::class;

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
            'start_date' => today(),
            'end_date' => today()->addDay(),
        ];
    }
}
