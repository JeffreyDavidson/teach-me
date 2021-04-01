<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSemester;
use App\Models\Semester;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class SemestersTableSeeder extends Seeder
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

        $seasons = ['Spring', 'Summer', 'Fall'];
        $years = [date('Y'), date('Y', strtotime('-1 year')), date('Y', strtotime('-2 years'))];
        $semesters = [];
        foreach ($years as $year) {
            foreach ($seasons as $season) {
                $semesters[] = "{$season} {$year}";
            }
        }

        foreach ($semesters as $semester) {
            if (Str::of($semester)->startsWith('Spring')) {
                $startDate = Carbon::parse('first day of February '.Str::of($semester)->after('Spring '));
                $endDate = Carbon::parse('first day of June '.Str::of($semester)->after('Spring '));
            } elseif (Str::of($semester)->startsWith('Summer')) {
                $startDate = Carbon::parse('first day of June '.Str::of($semester)->after('Summer '));
                $endDate = Carbon::parse('first day of September '.Str::of($semester)->after('Summer '));
            } elseif (Str::of($semester)->startsWith('Fall')) {
                $startDate = Carbon::parse('first day of September '.Str::of($semester)->after('Fall '));
                $yearString = (string) Str::of($semester)->after('Fall ');
                $yearInt = (int) $yearString + 1;
                $endDate = Carbon::parse('first day of January '.(string) $yearInt);
            }

            $semesterModel = Semester::factory()->create(['name' => $semester]);
            $courses = Course::inRandomOrder()->take(5)->get();

            foreach ($courses as $course) {
                $courseSemester = CourseSemester::factory()->create([
                    'semester_id' => $semesterModel,
                    'course_id' => $course->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);

                CourseSection::factory()->create([
                    'course_semester_id' => $courseSemester->id,
                    'teacher_id' => Teacher::inRandomOrder()->first()->id,
                    'start_time' => $startTime = Carbon::parse($this->faker->time('H:00')),
                    'end_time' => $startTime->copy()->addHour(),
                ]);
            }
        }
    }
}
