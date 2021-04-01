<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\CourseSection;
use App\Models\Semester;
use Livewire\Component;

class SemesterCourseSectionsList extends Component
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
        $query = CourseSection::query()
            ->with('course')
            ->where('semester_id', $this->semester->id)
            ->when($this->filters['search'], function ($query, $search) {
                $query->whereHas('course', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
            });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.semester-course-sections.course-sections-list', [
            'courseSections' => $this->rows,
        ]);
    }
}
