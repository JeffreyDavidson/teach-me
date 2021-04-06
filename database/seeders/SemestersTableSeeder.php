<?php

namespace Database\Seeders;

use App\Models\CourseSection;
use App\Models\CourseSectionSemester;
use App\Models\Semester;
use App\Models\Student;
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
            $dates = $this->generateSemesterDates($semesterName);

            $semester = Semester::factory()->create([
                'name' => $semesterName,
                'start_date' => $dates['startDate'],
                'end_date' => $dates['endDate'],
            ]);

            foreach (CourseSection::all() as $courseSection) {
                $this->createCourseSectionSemester($courseSection, $semester);
            }
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
        $years = [
            date('Y', strtotime('-2 years')),
            date('Y', strtotime('-1 year')),
            date('Y'),
        ];
        $semesterNames = [];

        foreach ($years as $year) {
            foreach ($seasons as $season) {
                $semesterNames[] = "{$season} {$year}";
            }
        }

        return $semesterNames;
    }

    /**
     * Creates dates for each semester.
     *
     * @param  string $semesterName
     * @return array
     */
    protected function generateSemesterDates($semesterName)
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
     * Create a course section semester.
     *
     * @param  \App\Models\CourseSection $courseSection
     * @param  \App\Models\Semester $semester
     * @return void
     */
    protected function createCourseSectionSemester($courseSection, $semester)
    {
        $courseSectionDates = $this->generateCourseSectionSemesterDates($courseSection->day, $semester->start_date, $semester->end_date);

        $courseSectionSemester = CourseSectionSemester::factory()->create([
            'course_section_id' => $courseSection->id,
            'semester_id' => $semester->id,
            'start_date' => $courseSectionDates['startDate'],
            'end_date' => $courseSectionDates['endDate'],
        ]);

        $this->addStudentsToCourseSectionSemester($courseSectionSemester);
    }

    /**
     * Create course section semester dates from semester start dates.
     *
     * @param  string $dayOfTheWeek
     * @param  string $semesteStartDate
     * @param  string $semesterEndDate
     * @return array
     */
    protected function generateCourseSectionSemesterDates($dayOfTheWeek, $semesteStartDate, $semesterEndDate)
    {
        $dates = [];
        $dates['startDate'] = Carbon::parse($semesteStartDate)->is($dayOfTheWeek) ?
            Carbon::parse($semesteStartDate) :
            Carbon::parse($semesteStartDate)->next($dayOfTheWeek);
        $dates['endDate'] = Carbon::parse($semesterEndDate)->is($dayOfTheWeek) ?
            Carbon::parse($semesterEndDate) :
            Carbon::parse($semesterEndDate)->previous($dayOfTheWeek);

        return $dates;
    }

    /**
     * Add students to a course section semester.
     *
     * @param  \App\Models\CourseSectionSemester $courseSectionSemester
     * @return void
     */
    protected function addStudentsToCourseSectionSemester(CourseSectionSemester $courseSectionSemester)
    {
        $students = Student::inRandomOrder()->take(5)->get();

        foreach ($students as $student) {
            $courseSectionSemester->students()->attach($student);
        }
    }
}
