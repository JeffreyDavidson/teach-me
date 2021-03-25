<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    /**
     * Create a new course.
     *
     * @param  array $data
     * @return App\Models\Course
     */
    public function create($data)
    {
        $course = Course::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $course;
    }
}
