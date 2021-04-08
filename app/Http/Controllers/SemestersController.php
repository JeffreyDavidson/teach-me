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

        $terms = [
            '0' => 'Please choose a term',
            'Spring' => 'Spring',
            'Summer' => 'Summer',
            'Fall' => 'Fall',
        ];

        $years = [
            '0' => 'Please choose a year',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
            '2025' => '2025',
        ];

        return view('semesters.create', [
            'semester' => $semester,
            'terms' => $terms,
            'years' => $years,
            'courses' => Course::allForDropdown(),
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
}
