<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Student extends User
{
    use HasFactory, HasParent;

    /**
     * Get the course sections semesters of the student.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courseSectionSemesters()
    {
        return $this->belongsToMany(CourseSectionSemester::class, 'course_section_semester_student', 'student_id', 'section_semester_id');
    }
}
