<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Semester;

class SemesterCourseSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  App\Models\Semester  $semester
     * @param  App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function index(Semester $semester, Course $course)
    {
        $this->authorize('viewAny', CourseSection::class);

        return view('semesters.course-sections', compact('semester', 'course'));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Semester  $semester
     * @param  App\Models\Course  $course
     * @param  App\Models\Semester  $semester
     * @return \Illuminate\View\View
     */
    public function show(Semester $semester, Course $course, CourseSection $section)
    {
        $this->authorize('view', CourseSection::class);

        return view('semesters.course-section-details', compact('semester', 'course', 'section'));
    }
}
