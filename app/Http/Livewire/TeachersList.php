<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Teacher;
use Livewire\Component;

class TeachersList extends Component
{
    use WithSorting, WithCachedRows, WithPerPagePagination;

    protected $paginationTheme = 'bootstrap';

    public function getRowsQueryProperty()
    {
        $query = Teacher::query();

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.teachers.teachers-list', [
            'teachers' => $this->rows,
        ]);
    }
}
