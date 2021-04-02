<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Semester;
use Livewire\Component;

class SemestersList extends Component
{
    use WithPerPagePagination, WithSorting;

    /**
     * Pagination theme to be used for view.
     *
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * Accept parameters in the query.
     *
     * @var array
     */
    protected $queryString = ['sorts'];

    /**
     * Determine if filters should be displayed.
     *
     * @var bool
     */
    public $showFilters = false;

    /**
     * Array of filters for querying database.
     *
     * @var array
     */
    public $filters = [
        'search' => '',
    ];

    /**
     * Tasks ran when page value is changed.
     *
     * @param  string $value
     * @return void
     */
    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    /**
     * Toggle visibility of filters.
     *
     * @return void
     */
    public function toggleShowFilters()
    {
        $this->showFilters = ! $this->showFilters;
    }

    /**
     * Reset the filters array to empty.
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->reset('filters');
    }

    /**
     * Retrieve collection of resources.
     *
     * @return void
     */
    public function getRowsQueryProperty()
    {
        $query = Semester::query()
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
            });

        return $this->applySorting($query);
    }

    /**
     * Get the paginated collection of resources.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.semesters.semesters-list', [
            'semesters' => $this->rows,
        ]);
    }
}
