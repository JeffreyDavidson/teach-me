<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSemesterRequest;
use App\Models\Course;
use App\Models\Semester;
use App\Services\SemesterService;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Semester::class);

        return view('semesters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  App\Models\Semester $semester
     * @return \Illuminate\View\View
     */
    public function create(Semester $semester)
    {
        $this->authorize('create', Semester::class);

        return view('semesters.create', [
            'semester' => $semester,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateSemesterRequest $request
     * @param  App\Services\SemesterService $semesterService
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSemesterRequest $request, SemesterService $semesterService)
    {
        $semesterService->create($request->validated());

        return redirect()->route('semesters.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Semester
     * @return \Illuminate\View\View
     */
    public function edit(Semester $semester)
    {
        $this->authorize('update', $semester);

        return view('semesters.edit', compact('semester'));
    }
}
