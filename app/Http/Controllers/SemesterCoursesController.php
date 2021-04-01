<?php

namespace App\Http\Controllers;

use App\Models\Semester;

class SemesterCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  App\Models\Semester  $semester
     * @return \Illuminate\View\View
     */
    public function index(Semester $semester)
    {
        return view('semester-courses.index', compact('semester'));
    }
}
