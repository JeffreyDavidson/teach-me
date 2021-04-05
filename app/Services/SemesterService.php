<?php

namespace App\Services;

use App\Events\SemesterCreated;
use App\Models\Semester;

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

        SemesterCreated::dispatch($semester);

        return $semester;
    }
}
