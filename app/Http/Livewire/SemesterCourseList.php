<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SemesterCourseList extends Component
{
    use WithPerPagePagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $showFilters = false;
    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Semester $semester;

    public function mount(Semester $semester)
    {
        $this->semester = $semester;
    }

    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    public function toggleShowFilters()
    {
        $this->showFilters = ! $this->showFilters;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = Course::query()
            ->whereHas('semesters', function (Builder $query) {
                $query->where('semester_id', $this->semester->id);
            })
            ->join('course_semester', 'course_semester.course_id', '=', 'courses.id')
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
            });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.semesters.course-list', [
            'courses' => $this->rows,
        ]);
    }
}
