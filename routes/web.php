<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Faculty\FacultyController;
use App\Http\Controllers\Faculty\AchievementReviewController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\AchievementController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // Future routes: users, courses, settings, etc.
});

// Faculty Routes
Route::prefix('faculty')->name('faculty.')->middleware(['auth', 'role:faculty'])->group(function () {
    Route::get('/', [FacultyController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/achievements/{achievement}', [AchievementReviewController::class, 'show'])->name('achievements.show');
    Route::put('/achievements/{achievement}', [AchievementReviewController::class, 'update'])->name('achievements.update');
    Route::get('/achievements/{achievement}/download', [AchievementReviewController::class, 'download'])->name('achievements.download');
    
    // Future routes: classes, grades, attendance, etc.
});

// Student Routes
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/achievements/create', [AchievementController::class, 'create'])->name('achievements.create');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');
    
    // Future routes: schedule, grades, assignments, etc.
});
