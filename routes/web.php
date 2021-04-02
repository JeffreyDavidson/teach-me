<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseSectionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterCoursesController;
use App\Http\Controllers\SemesterCourseSectionsController;
use App\Http\Controllers\SemestersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('teachers', TeachersController::class);
    Route::resource('students', StudentsController::class);
    Route::resource('courses', CoursesController::class);
    Route::resource('semesters', SemestersController::class);

    Route::get('semesters/{semester}/courses/{course}/course-sections', [SemesterCourseSectionsController::class, 'index'])->name('semesters.courses.sections.index');
    Route::get('semesters/{semester}/courses/{course}/course-sections/{section}', [SemesterCourseSectionsController::class, 'show'])->name('semesters.courses.sections.show');
    Route::get('semesters/{semester}/courses', [SemesterCoursesController::class, 'index'])->name('semesters.courses.index');
});
