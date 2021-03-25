<?php

namespace App\Http\Controllers;

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
}
