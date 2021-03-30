<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    /**
     * Get course sections for the semester.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseSections()
    {
        return $this->hasMany(CourseSection::class);
    }
}
