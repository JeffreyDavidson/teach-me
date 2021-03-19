<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Teacher;
use Livewire\Component;

class TeachersList extends Component
{
    use WithPerPagePagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['sorts'];

    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    public function getRowsQueryProperty()
    {
        $query = Teacher::query()
            ->select('*')
            ->selectRaw("CONCAT(last_name, ', ', first_name) as full_name");

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.teachers.teachers-list', [
            'teachers' => $this->rows,
        ]);
    }
}
