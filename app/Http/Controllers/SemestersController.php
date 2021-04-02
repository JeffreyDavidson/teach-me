<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSemesterRequest;
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

        return view('semesters.create', compact('semester'));
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
}
