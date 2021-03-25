<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Student::class);

        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Models\Student $student
     * @return \Illuminate\View\View
     */
    public function create(Student $student)
    {
        $this->authorize('create', Student::class);

        return view('students.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateStudentRequest $request
     * @param  App\Services\StudentService $studentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateStudentRequest $request, StudentService $studentService)
    {
        $studentService->create($request->validated());

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {
        $this->authorize('update', $student);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateStudentRequest $request
     * @param  App\Models\Student $student
     * @param  App\Services\StudentService $studentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student, StudentService $studentService)
    {
        $studentService->update($student, $request->validated());

        return redirect()->route('students.index');
    }
}
