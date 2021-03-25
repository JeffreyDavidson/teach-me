<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Course::class);

        return view('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Models\Course $course
     * @return \Illuminate\View\View
     */
    public function create(Course $course)
    {
        $this->authorize('create', Course::class);

        return view('courses.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateCourseRequest $request
     * @param  App\Services\CourseService $courseService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCourseRequest $request, CourseService $courseService)
    {
        $courseService->create($request->validated());

        return redirect()->route('courses.index');
    }
}
