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
}
