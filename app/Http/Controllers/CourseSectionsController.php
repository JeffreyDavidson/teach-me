<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Course;
use App\Models\CourseSection;

class CourseSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function index(Course $course)
    {
        $this->authorize('viewAny', CourseSection::class);

        return view('course-sections.index', compact('course'));
    }
}
