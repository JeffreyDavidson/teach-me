<?php

namespace App\Services;

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
            'name' => $data['name'],
        ]);

        return $semester;
    }
}
