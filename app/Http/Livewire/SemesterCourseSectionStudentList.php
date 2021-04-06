<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\CourseSection;
use App\Models\CourseSectionSemester;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SemesterCourseSectionStudentList extends Component
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
     * Course section semester to be used for gathering students.
     *
     * @var App\Models\CourseSectionSemester
     */
    public CourseSectionSemester $courseSectionSemester;

    /**
     * Apply properties to the instance.
     *
     * @param  App\Models\CourseSectionSemester $courseSectionSemester
     * @return void
     */
    public function mount(CourseSectionSemester $courseSectionSemester)
    {
        $this->courseSectionSemester = $courseSectionSemester;
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
        $query = Student::query()
            ->whereHas('courseSectionSemesters', function (Builder $query) {
                $query->where('section_semester_id', $this->courseSectionSemester->id);
            })
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('first_name', 'like', '%'.$search.'%')->orWhere('last_name', 'like', '%'.$search.'%');
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
        return view('livewire.semesters.course-section-student-list', [
            'students' => $this->rows,
        ]);
    }
}
