<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Semester extends Model
{
    use HasFactory, HasSlug, HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
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
     * Get course sections for the semester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courseSections()
    {
        return $this->belongsToMany(CourseSection::class)->using(CourseSectionSemester::class)->withTimestamps();
    }

    public function courseSectionSemesters()
    {
        return $this->hasMany(CourseSectionSemester::class, 'semester_id');
    }

    /**
     * Get the courses for the semester.
     *
     * @return \Staudenmeir\EloquentHasManyDeep
     */
    public function courses()
    {
        return $this->hasManyDeep(
            Course::class,
            [CourseSectionSemester::class, CourseSection::class],
            ['semester_id', 'course_id', 'id']
        )->withIntermediate(CourseSectionSemester::class);
    }

    public function getTermAttribute()
    {
        return substr($this->name, 0, strpos($this->name, ' '));
    }

    public function getYearAttribute()
    {
        return substr($this->name, -4, 4);
    }
}
