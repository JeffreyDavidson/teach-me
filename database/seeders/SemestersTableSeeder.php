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
            Semester::factory()->create(['name' => $semester]);
        }
    }
}
