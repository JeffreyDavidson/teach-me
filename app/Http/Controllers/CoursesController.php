<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Course
     * @return \Illuminate\View\View
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateCourseRequest $request
     * @param  App\Models\Course $course
     * @param  App\Services\CourseService $courseService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCourseRequest $request, Course $course, CourseService $courseService)
    {
        $courseService->update($course, $request->validated());

        return redirect()->route('courses.index');
    }
}
