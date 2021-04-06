<?php

namespace Database\Factories;

use App\Models\CourseSection;
use App\Models\CourseSectionSemester;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseSectionSemesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseSectionSemester::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_section_id' => CourseSection::factory(),
            'semester_id' => Semester::factory(),
            'start_date' => today(),
            'end_date' => today()->addDay(),
        ];
    }
}
