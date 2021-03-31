<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use App\Models\CourseSection;
use Livewire\Component;

class CourseSectionsList extends Component
{
    use WithPerPagePagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $showFilters = false;
    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
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
            ->with('semester')
            ->where('course_id', $this->course->id)
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('semester', 'like', '%'.$search.'%');
            });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.course-sections.course-sections-list', [
            'courseSections' => $this->rows,
        ]);
    }
}
