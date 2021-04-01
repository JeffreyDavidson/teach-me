<?php

namespace App\Http\Controllers;

use App\Models\CourseSection;
use App\Models\Semester;

class SemesterCourseSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  App\Models\Semester  $semester
     * @return \Illuminate\View\View
     */
    public function index(Semester $semester)
    {
        $this->authorize('viewAny', CourseSection::class);

        return view('course-sections.index', compact('semester'));
    }
}
