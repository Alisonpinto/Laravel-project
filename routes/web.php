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
    Route::get('/login', function () {
        \App\Models\User::updateOrCreate(
            ['email' => 'alisonpinto955@gmail.com'],
            ['name' => 'Alison Pinto', 'password' => \Illuminate\Support\Facades\Hash::make('5024148'), 'role' => 'student']
        );
        \App\Models\User::updateOrCreate(
            ['email' => 'jawaan2720@gmail.com'],
            ['name' => 'Faculty User', 'password' => \Illuminate\Support\Facades\Hash::make('5024125'), 'role' => 'faculty']
        );
        return app(\App\Http\Controllers\AuthController::class)->login();
    })->name('login');
    
    Route::get('/debug-db', function() {
        return [
            'users' => \App\Models\User::all(),
            'achievements' => \App\Models\Achievement::all(),
            'php' => [
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'post_max_size' => ini_get('post_max_size'),
                'sys_temp_dir' => sys_get_temp_dir(),
                'php_ini' => php_ini_loaded_file()
            ]
        ];
    });

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
