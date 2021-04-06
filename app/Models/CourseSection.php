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
}
