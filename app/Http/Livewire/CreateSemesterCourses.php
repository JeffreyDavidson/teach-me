<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Semester;
use Livewire\Component;

class CreateSemesterCourses extends Component
{
    /**
     *  @var App\Models\Semester
     */
    public Semester $semester;

    /**
     * List of all courses.
     *
     * @var array
     */
    public $courses;

    /**
     * Semester that will duplicated.
     *
     * @var int
     */
    public $semesterIdToDuplicate;

    /**
     * List of courses of semester to duplicate.
     *
     * @var array
     */
    public $selectedCourses;

    /**
     * Apply properties to the instance.
     *
     * @param  App\Models\Semester $semester
     * @return void
     */
    public function mount(Semester $semester)
    {
        $this->semester = $semester;
        $this->courses = Course::allForDropdown()->toArray();
        $this->addSemesterCourses();
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->dispatchBrowserEvent('initListBox');

        return view('livewire.semesters.create-semester-courses', [
            'semesters' => Semester::orderBy('start_date')->pluck('name', 'id')->prepend('Please choose a semester', '0'),
            'semester' => $this->semester,
            'courses' => $this->courses,
        ]);
    }

    /**
     * Updates selected courses of semester to duplicate.
     *
     * @param  int $value
     * @return array
     */
    public function updatedSemesterIdToDuplicate($value)
    {
        if ($value == 0) {
            return $this->selectedCourses = [];
        }

        $duplicateSemester = Semester::find($value);

        $courses = $duplicateSemester->courseSections->map(function ($section) {
            return $section->course;
        });

        $this->getUniqueCoursesForDropdown($courses);
    }

    public function selectCourse($course)
    {
        $this->selectedCourses[] = $course;
    }

    public function removeCourse($course)
    {
        if ($this->semesterIdToDuplicate != 0) {
            $this->semesterIdToDuplicate = 0;
        }

        $key = array_search($course, $this->selectedCourses);
        if (false !== $key) {
            unset($this->selectedCourses[$key]);
        }
    }

    public function addSemesterCourses()
    {
        $courses = $this->semester->courseSections->map(function ($section) {
            return $section->course;
        });

        $this->getUniqueCoursesForDropdown($courses);
    }

    public function getUniqueCoursesForDropdown($courses)
    {
        $uniqueCourses = $courses->unique(function ($course) {
            return $course->name;
        });

        $this->selectedCourses = $uniqueCourses->pluck('name', 'id')->toArray();
    }
}
