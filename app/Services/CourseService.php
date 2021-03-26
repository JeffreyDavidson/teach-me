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

    /**
     * Update a specific course with given data.
     *
     * @param  App\Models\Course $course
     * @param  array $data
     * @return App\Models\Course $course
     */
    public function update($course, $data)
    {
        $course->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $course;
    }
}
