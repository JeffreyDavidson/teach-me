<?php

namespace Database\Factories;

use App\Models\CourseSectionMeeting;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseSectionMeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseSectionMeeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $today = Carbon::today();

        return [
            'teacher_id' => Teacher::factory(),
            'day' => Carbon::today()->format('l'),
            'start_time' => $today->toTimeString(),
            'end_time' => $today->addHour()->toTimeString(),
        ];
    }
}
