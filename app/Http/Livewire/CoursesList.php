<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use Livewire\Component;

class CoursesList extends Component
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
     * Retrieve courses.
     *
     * @return void
     */
    public function getRowsQueryProperty()
    {
        $query = Course::query()
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
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
     * Show the courses.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.courses.courses-list', [
            'courses' => $this->rows,
        ]);
    }
}
