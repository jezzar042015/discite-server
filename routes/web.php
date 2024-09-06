<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'spa')->name('dashboard');
    Route::view('/courses', 'spa')->name('courses');
    Route::view('/courses/{id}/modules', 'spa')->name('course.modules');
    Route::view('/modules/{id}/lessons', 'spa')->name('module.lessons');
    Route::view('/lessons/{id}', 'spa')->name('lesson');
    Route::view('/lessons/{id}/exercises', 'spa')->name('lesson.exercises');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
