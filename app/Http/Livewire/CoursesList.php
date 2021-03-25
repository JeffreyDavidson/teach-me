<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use Livewire\Component;

class CoursesList extends Component
{
    use WithPerPagePagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $showFilters = false;
    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

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
        return view('livewire.courses.courses-list', [
            'courses' => $this->rows,
        ]);
    }
}
