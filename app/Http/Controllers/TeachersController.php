<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Teacher::class);

        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Teacher $teacher)
    {
        $this->authorize('create', Teacher::class);

        return view('teachers.create', compact('teacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateTeacherRequest $request
     * @param  App\Services\TeacherService $teacherService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTeacherRequest $request, TeacherService $teacherService)
    {
        $teacherService->create($request->validated());

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $this->authorize('view', $teacher);

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Teacher $teacher)
    {
        $this->authorize('update', $teacher);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateTeacherRequest $request
     * @param  App\Models\Teacher $teacher
     * @param  App\Services\TeacherService $teacherService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher, TeacherService $teacherService)
    {
        $teacherService->update($teacher, $request->validated());

        return redirect()->route('teachers.index');
    }
}
