<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
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
}
