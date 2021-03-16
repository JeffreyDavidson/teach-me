<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
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
    public function create()
    {
        $this->authorize('create', Teacher::class);

        return view('teachers.create');
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
}
