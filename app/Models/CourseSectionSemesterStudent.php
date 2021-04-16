<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseSectionSemesterStudent extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the semester for the course sememester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(Student::class, 'user_id');
    }

    /**
     * Get the course section for the course semester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseSectionSemester()
    {
        return $this->belongsTo(CourseSectionSemester::class);
    }
}
