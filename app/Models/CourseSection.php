<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'teacher_id',
        'day',
        'start_time',
        'end_time',
    ];

    /**
     * Get the course of the course section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the semesters of the course section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseSectionSemesters()
    {
        return $this->hasMany(CourseSectionSemester::class);
    }

    /**
     * Get the semesters of the course section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters()
    {
        return $this->belongsToMany(Semester::class)
                ->using(CourseSectionSemester::class)
                ->withTimestamps()
                ->withPivot(['start_date', 'end_date']);
    }

    /**
     * Get the teacher of the course section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted start time.
     *
     * @param  string  $value
     * @return string
     */
    public function getStartTimeAttribute($value)
    {
        return Carbon::createFromTimeString($value)->format('H:ia');
    }

    /**
     * Get the formatted end time.
     *
     * @param  string  $value
     * @return string
     */
    public function getEndTimeAttribute($value)
    {
        return Carbon::createFromTimeString($value)->format('H:ia');
    }

    /**
     * Get the formatted start time.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return "{$this->day} {$this->start_time } - {$this->end_time}";
    }

    public function scopeWithStudentsCountForCourseSection($query, $semesterId)
    {
        return $query->addSelect(['students_count' => CourseSectionSemesterStudent::query()->selectRaw('count(*) as count')
            ->join(
                'course_section_semester',
                'course_section_semester_student.section_semester_id',
                '=', 'course_section_semester.id'
            )
            ->where('course_section_semester.semester_id', '=', $semesterId)
            ->whereColumn('course_sections.id', 'course_section_semester.course_section_id'),
        ]);
    }

    /**
     * Scope a query to only include course sections for specific course.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  App\Models\Course $course
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForCourse($query, $course)
    {
        return $query->where('course_id', $course->id);
    }
}
