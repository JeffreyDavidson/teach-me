<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Semester;
use Livewire\Component;

class CreateSemesterCourses extends Component
{
    public Semester $semester;

    public $courses;

    public $default;

    public $selectedCourses;

    public function mount(Semester $semester)
    {
        $this->semester = $semester;
        $this->courses = Course::allForDropdown()->toArray();
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.semesters.create-semester-courses', [
            'semesters' => Semester::orderBy('start_date')->pluck('name', 'id')->prepend('Please choose a semester', '0'),
            'semester' => $this->semester,
            'courses' => $this->courses,
        ]);
    }

    public function updatedDefault($value)
    {
        if ($value == 0) {
            $this->dispatchBrowserEvent('livewire:load');

            return $this->selectedCourses = [];
        }

        $duplicateSemester = Semester::find($value);

        $courses = $duplicateSemester->courseSections->map(function ($section) {
            return $section->course;
        });

        $uniqueCourses = $courses->unique(function ($course) {
            return $course->name;
        });

        $uniqueCourses->map(function ($course) {
            return [
                'label' => $course->name,
                'value' => $course->id,
            ];
        })->toArray();

        $this->selectedCourses = $uniqueCourses->pluck('id')->toArray();

        $this->dispatchBrowserEvent('livewire:load');
    }
}
