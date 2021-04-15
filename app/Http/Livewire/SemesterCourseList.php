<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Semester;
use Livewire\Component;

class SemesterCourseList extends Component
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
     * Apply properties to the instance.
     *
     * @param  App\Models\Semester $semester
     * @return void
     */
    public function mount(Semester $semester)
    {
        $this->semester = $semester;
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
     * Retrieve sorted courses attached to the semester.
     *
     * @return void
     */
    public function getRowsQueryProperty()
    {
        $query = $this->semester
            ->courses()
            ->addSelect(['students_count' => function ($query) {
                $query->select('name')
                    ->from('course_section_semester_students')
                    ->whereColumn('semester_id', 'semesters.id')
                    ->count();
            }])
            ->newQuery()
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
            });

        // $query2 = $this
        //     ->semester
        //     ->courseSectionSemesters()
        //     ->withCount('students')
        //     ->where('course_section_id', 1)
        //     ->get()
        //     ->sum('students_count');
        // dd($query2);
        dd($query);

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
        return view('livewire.semesters.course-list', [
            'courses' => $this->rows,
        ]);
    }
}
