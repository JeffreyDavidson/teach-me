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

    /**
     * Get semesters for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters()
    {
        return $this->belongsToMany(Semester::class)->withTimestamps()->withPivot(['start_date', 'end_date']);
    }

    public static function allForDropdown()
    {
        return static::orderBy('name')->get()->map(function ($course) {
            return [
                'label' => $course->name,
                'value' => $course->id,
            ];
        });
    }
}
