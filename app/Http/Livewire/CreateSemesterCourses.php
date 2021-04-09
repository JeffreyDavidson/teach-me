<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Semester;
use Livewire\Component;

class CreateSemesterCourses extends Component
{
    public Semester $semester;

    public $courses;

    public function mount(Semester $semester)
    {
        $this->semester = $semester;
        $this->courses = Course::allForDropdown()->prepend(['label' => 'Please choose a course', 'value' => 0]);
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.semesters.create-semester-courses', [
            'semesters' => Semester::orderBy('start_date')->pluck('name', 'id'),
            'semester' => $this->semester,
            'courses' => $this->courses,
        ]);
    }

    public function changeEvent($value)
    {
        $duplicateSemester = Semester::find($value);

        $courses = $duplicateSemester->courseSections->map(function ($section) {
            return $section->course;
        });

        $uniqueCourses = $courses->unique(function ($course) {
            return $course->name;
        });

        $this->courses = $uniqueCourses;
    }
}
