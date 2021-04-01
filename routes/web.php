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
    Route::resource('courses.course-sections', CourseSectionsController::class)->parameters(
        ['course-sections' => 'section']
    );

    Route::resource('semesters.course-sections', SemesterCourseSectionsController::class)->parameters(
        ['course-sections' => 'section']
    );

    Route::get('semesters/{semester}/courses', [SemesterCoursesController::class, 'index'])->name('semesters.courses.index');
});
