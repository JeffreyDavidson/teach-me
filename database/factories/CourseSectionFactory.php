<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Teacher;
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
        $semesters = ['Spring', 'Summer', 'Fall'];
        $randomSemester = $semesters[mt_rand(0, count($semesters) - 1)];

        $days = ['M/W/F', 'Tue/Thu'];
        $randomDays = $days[mt_rand(0, count($days) - 1)];

        return [
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
            'semester' => $randomSemester.' '.date('Y'),
            'name' => $randomDays.' '.date('gA'),
        ];
    }
}
