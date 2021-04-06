<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Semester::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $semesters = ['Spring', 'Summer', 'Fall'];
        $randomSemester = $semesters[mt_rand(0, count($semesters) - 1)];

        return [
            'name' => $randomSemester.' '.$this->faker->numberBetween(1111, 2021),
            'start_date' => today(),
            'end_date' => today()->addDay(),
        ];
    }
}
