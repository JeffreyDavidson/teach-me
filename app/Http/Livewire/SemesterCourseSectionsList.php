<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SemesterCourseSectionsList extends Component
{
    use WithPerPagePagination, WithSorting;

    /**
     * Pagination theme to be used for view.
     *
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * Accepted keys for the query string.
     *
     * @var array
     */
    protected $queryString = ['sorts'];

    /**
     * Define on if filters should be shown by default.
     *
     * @var bool
     */
    public $showFilters = false;

    /**
     * Define allowed filters for page.
     *
     * @var array
     */
    public $filters = [
        'search' => '',
    ];

    /**
     * Semester to be used for gathering courses.
     *
     * @var App\Models\Semester
     */
    public Semester $semester;

    /**
     * Course to be used for gathering course sections.
     *
     * @var App\Models\Course
     */
    public Course $course;

    /**
     * Apply properties to the instance.
     *
     * @param  App\Models\Semester $semester
     * @param  App\Models\Course $course
     * @return void
     */
    public function mount(Semester $semester, Course $course)
    {
        $this->semester = $semester;
        $this->course = $course;
    }

    /**
     * Undocumented function.
     *
     * @param  int $value
     * @return void
     */
    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    /**
     * Toggle the visibility of page filters.
     *
     * @return void
     */
    public function toggleShowFilters()
    {
        $this->showFilters = ! $this->showFilters;
    }

    /**
     * Reset all filters to default values.
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->reset('filters');
    }

    /**
     * Retrieve sorted course sectionss attached to the semester course.
     *
     * @return void
     */
    public function getRowsQueryProperty()
    {
        $query = $this->semester
            ->courseSections()
            ->where('course_id', $this->course->id)
            ->withStudentsCountForCourseSection($this->semester->id)
            ->newQuery()
            ->when($this->filters['search'], function ($query, $search) {
                $query->whereHas('teacher', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%'.$search.'%')->orWhere('last_name', 'like', '%'.$search.'%');
                });
            });

        return $this->applySorting($query);
    }

    /**
     * Paginate component data collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    /**
     * Show the courses for the semester.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.semesters.course-sections-list', [
            'courseSections' => $this->rows,
        ]);
    }
}
