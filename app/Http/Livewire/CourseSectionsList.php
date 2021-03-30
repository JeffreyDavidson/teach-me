<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Database\Eloquent\Builder;
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
            ->select('*')
            ->selectRaw("CONCAT(users.first_name, ' ', users.last_name) as teacher_name")
            ->join('users', 'users.id', '=', 'course_sections.teacher_id')
            ->where('course_id', $this->course->id)
            ->when($this->filters['search'], function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('semester', 'like', '%'.$search.'%')
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhereHas('teacher', function (Builder $query) use ($search) {
                            $query->where('first_name', 'like', '%'.$search.'%')
                                ->orWhere('last_name', 'like', '%'.$search.'%');
                        });
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
        return view('livewire.course-sections.course-sections-list', [
            'courseSections' => $this->rows,
        ]);
    }
}
