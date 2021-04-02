<?php

namespace App\Http\Controllers;

use App\Models\Semester;

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
}
