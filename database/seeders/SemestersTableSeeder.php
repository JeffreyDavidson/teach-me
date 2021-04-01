<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            Semester::factory()
                ->hasAttached(Course::inRandomOrder()->take(5)->get(), ['start_date' => $startDate, 'end_date' => $endDate])
                ->has(CourseSection::factory()->count(20)->state(new Sequence(
                    fn () => ['course_id' => Course::inRandomOrder()->first(), 'start_date' => $startDate, 'end_date' => $endDate],
                )))
                ->create(['name' => $semester]);
        }
    }
}
