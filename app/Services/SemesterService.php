<?php

namespace App\Services;

use App\Events\SemesterCreated;
use App\Models\CourseSection;
use App\Models\Semester;
use Carbon\Carbon;

class SemesterService
{
    /**
     * Create a new semester.
     *
     * @param  array $data
     * @return App\Models\Semester
     */
    public function create($data)
    {
        $semester = Semester::create([
            'name' => $data['term'].' '.$data['year'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        $courseSections = CourseSection::whereIn('course_id', $data['courses'])->get();

        foreach ($courseSections as $section) {
            $courseSectionDates = $this->generateCourseSectionSemesterDates($section->day, $semester->start_date, $semester->end_date);
            $semester->courseSections()->attach($section, ['start_date' => $courseSectionDates['startDate'], 'end_date' => $courseSectionDates['endDate']]);
        }

        return $semester;
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
}
