<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeachersList extends Component
{
    use WithPagination;

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
