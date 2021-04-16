<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Retrieve sections for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function courseSectionSemesters()
    {
        return $this->hasManyThrough(CourseSectionSemester::class, CourseSection::class);
    }

    public static function allForDropdown()
    {
        return static::orderBy('name')->get()->pluck('name', 'id');
    }

    public function scopeWithTotalStudentsCountForSemester($query, $semesterId)
    {
        return $query->addSelect(['students_count' => CourseSectionSemesterStudent::query()->selectRaw('count(*) as count')
            ->join(
                'course_section_semester',
                'course_section_semester_student.section_semester_id',
                '=', 'course_section_semester.id'
            )
            ->where('course_section_semester.semester_id', '=', $semesterId)
            ->join('course_sections', 'course_sections.id', '=', 'course_section_semester.course_section_id')
            ->whereColumn('courses.id', 'course_sections.course_id'),
        ]);
    }
}
