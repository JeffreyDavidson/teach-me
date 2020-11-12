<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeachersList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;

    public function updatedPerPage($value)
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.teachers.teachers-list', [
            'teachers' => Teacher::paginate($this->perPage),
        ]);
    }
}
