<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\CourseLecturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('web.home');
Route::get('/mon-hoc', [CourseController::class, 'webIndex'])->name('web.courses.index');
Route::get('/mon-hoc/{id}', [CourseController::class, 'webShow'])->name('web.courses.show');

Route::get('/thong-bao', [AnnouncementController::class, 'webIndex'])->name('web.announcements.index');
Route::get('/thong-bao/{id}', [AnnouncementController::class, 'webShow'])->name('web.announcements.show');

Route::get('/tai-lieu', [DocumentController::class, 'webIndex'])->name('web.documents.index');
Route::get('/luan-van', [ThesisController::class, 'webIndex'])->name('web.theses.index');


Route::get('/giang-vien', [LecturerController::class, 'webIndex'])->name('web.lecturers.index');

Route::post('/dang-ky-hoc', [RegisterController::class, 'store'])->name('web.register.store');

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth (login/logout)
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('loginForm');
    Route::post('login', [AuthController::class, 'login'])->name('loginSubmit');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Register
        Route::get('registers', [RegisterController::class, 'index'])->name('registers.index');
        Route::get('registers/{id}/edit', [RegisterController::class, 'edit'])->name('registers.edit');
        Route::put('registers/{id}', [RegisterController::class, 'update'])->name('registers.update');
        Route::delete('registers/{id}', [RegisterController::class, 'destroy'])->name('registers.destroy');

        // Pages
        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('pages/{id}', [PageController::class, 'show'])->name('pages.show');
        Route::get('pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
        
        // Announcements
        Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('announcements/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');
        Route::get('announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // Courses
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('courses/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

        // Course Lecturers
        Route::get('courses/{id}/lecturers', [CourseLecturerController::class, 'index'])->name('courses.lecturers.index');
        Route::get('courses/{id}/lecturers/create', [CourseLecturerController::class, 'create'])->name('courses.lecturers.create');
        Route::post('courses/{id}/lecturers', [CourseLecturerController::class, 'store'])->name('courses.lecturers.store');
        Route::delete('courses/{id}/lecturers/{lecturer_id}', [CourseLecturerController::class, 'destroy'])->name('courses.lecturers.destroy');

        // Lecturers
        Route::get('lecturers', [LecturerController::class, 'index'])->name('lecturers.index');
        Route::get('lecturers/create', [LecturerController::class, 'create'])->name('lecturers.create');
        Route::post('lecturers', [LecturerController::class, 'store'])->name('lecturers.store');
        Route::get('lecturers/{id}', [LecturerController::class, 'show'])->name('lecturers.show');
        Route::get('lecturers/{id}/edit', [LecturerController::class, 'edit'])->name('lecturers.edit');
        Route::put('lecturers/{id}', [LecturerController::class, 'update'])->name('lecturers.update');
        Route::delete('lecturers/{id}', [LecturerController::class, 'destroy'])->name('lecturers.destroy');

        // Documents
        Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
        Route::get('documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
        Route::put('documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
        Route::delete('documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

        // Theses
        Route::get('theses', [ThesisController::class, 'index'])->name('theses.index');
        Route::get('theses/create', [ThesisController::class, 'create'])->name('theses.create');
        Route::post('theses', [ThesisController::class, 'store'])->name('theses.store');
        Route::get('theses/{id}', [ThesisController::class, 'show'])->name('theses.show');
        Route::get('theses/{id}/edit', [ThesisController::class, 'edit'])->name('theses.edit');
        Route::put('theses/{id}', [ThesisController::class, 'update'])->name('theses.update');
        Route::delete('theses/{id}', [ThesisController::class, 'destroy'])->name('theses.destroy');

        // Courses <-> Lecturers
        Route::get('courses/{id}/lecturers', [CourseLecturerController::class, 'index'])->name('courses.lecturers.index');
        Route::post('courses/{id}/lecturers', [CourseLecturerController::class, 'store'])->name('courses.lecturers.store');
        Route::delete('courses/{id}/lecturers/{lecturer_id}', [CourseLecturerController::class, 'destroy'])->name('courses.lecturers.destroy');
    });
});


Route::get('/{slug}', [PageController::class, 'webShow'])->name('web.pages.show');
