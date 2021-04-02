<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Student extends User
{
    use HasFactory, HasParent;

    /**
     * Get the course sections of the student.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courseSections()
    {
        return $this->belongsToMany(CourseSection::class, 'course_section_student', 'student_id');
    }
}
