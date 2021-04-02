<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\CourseSemester;
use App\Models\Semester;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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

        $this->generateSemesters();
    }

    /**
     * Generate semesters needed for seeder.
     *
     * @return void
     */
    protected function generateSemesters()
    {
        foreach ($this->generateSemesterNames() as $semesterName) {
            $semester = Semester::factory()->create(['name' => $semesterName]);
            $courses = Course::inRandomOrder()->take(5)->get();

            $this->createCourseRequirements($semester, $courses);
        }
    }

    /**
     * Create semester names for last two years.
     *
     * @return array
     */
    protected function generateSemesterNames()
    {
        $seasons = ['Spring', 'Summer', 'Fall'];
        $years = [date('Y'), date('Y', strtotime('-1 year')), date('Y', strtotime('-2 years'))];
        $semesterNames = [];

        foreach ($years as $year) {
            foreach ($seasons as $season) {
                $semesterNames[] = "{$season} {$year}";
            }
        }

        return $semesterNames;
    }

    /**
     * Creates dates for each course during the semester.
     *
     * @param  string $semesterName
     * @return array
     */
    protected function generateCourseDates($semesterName)
    {
        $dates = [];

        if (Str::of($semesterName)->startsWith('Spring')) {
            $dates['startDate'] = Carbon::parse('first day of February '.Str::of($semesterName)->after('Spring '));
            $dates['endDate'] = Carbon::parse('first day of June '.Str::of($semesterName)->after('Spring '));
        } elseif (Str::of($semesterName)->startsWith('Summer')) {
            $dates['startDate'] = Carbon::parse('first day of June '.Str::of($semesterName)->after('Summer '));
            $dates['endDate'] = Carbon::parse('first day of September '.Str::of($semesterName)->after('Summer '));
        } elseif (Str::of($semesterName)->startsWith('Fall')) {
            $dates['startDate'] = Carbon::parse('first day of September '.Str::of($semesterName)->after('Fall '));
            $yearString = (string) Str::of($semesterName)->after('Fall ');
            $yearInt = (int) $yearString + 1;
            $dates['endDate'] = Carbon::parse('first day of January '.(string) $yearInt);
        }

        return $dates;
    }

    /**
     * Create course requirements during a semester.
     *
     * @param  \App\Models\Semester $semester
     * @param  \App\Models\Course $course
     * @return void
     */
    protected function createCourseRequirement($semester, $course)
    {
        $courseDates = $this->generateCourseDates($semester->name);

        $courseSemester = $this->createCourseSemester($semester, $course, $courseDates['startDate'], $courseDates['endDate']);

        $this->createCourseSection($courseSemester);
    }

    /**
     * Create coure requirements for each course in a semester.
     *
     * @param  \App\Models\Semester $semester
     * @param  \Illuminate\Database\Eloquent\Collection $courses
     * @return void
     */
    protected function createCourseRequirements(Semester $semester, Collection $courses)
    {
        foreach ($courses as $course) {
            $this->createCourseRequirement($semester, $course);
        }
    }

    /**
     * Create a course section for a course in a semester.
     *
     * @param  \App\Models\CourseSemester $courseSemester
     * @return void
     */
    protected function createCourseSection(CourseSemester $courseSemester)
    {
        CourseSection::factory()->create([
            'course_semester_id' => $courseSemester->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'day' => $this->faker->randomElement(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
            'start_time' => $startTime = Carbon::parse($this->faker->time('H:00')),
            'end_time' => $startTime->copy()->addHour(),
        ]);
    }

    /**
     * Create a course semester.
     *
     * @param  \App\Models\Semester $semester
     * @param  \App\Models\Course $course
     * @param  string $startDate
     * @param  string $endDate
     * @return \App\Models\CourseSemester
     */
    protected function createCourseSemester($semester, $course, $startDate, $endDate)
    {
        return CourseSemester::factory()->create([
            'semester_id' => $semester->id,
            'course_id' => $course->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
