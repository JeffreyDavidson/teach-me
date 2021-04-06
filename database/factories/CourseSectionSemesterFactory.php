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
        $courseSection = CourseSection::factory()->create();
        $semester = Semester::factory()->create();

        return [
            'course_section_id' => $courseSection->id,
            'semester_id' => $semester->id,
            'start_date' => Carbon::parse($semester->start_date)->is($courseSection->day) ?
                Carbon::parse($semester->start_date) :
                Carbon::parse($semester->start_date)->next($courseSection->day),
            'end_date' => Carbon::parse($semester->end_date)->is($courseSection->day) ?
                Carbon::parse($semester->end_date) :
                Carbon::parse($semester->end_date)->previous($courseSection->day),
        ];
    }
}
