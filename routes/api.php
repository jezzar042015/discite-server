<?php

use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index'])->name('users.all');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.one');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy.one');
Route::post('/users/register', [UserController::class, 'register'])->name('users.register');
Route::post('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'create']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/{id}', [ModuleController::class, 'show']);
Route::post('/modules', [ModuleController::class, 'create']);
Route::put('/modules/{id}', [ModuleController::class, 'update']);
Route::delete('/modules/{id}', [ModuleController::class, 'destroy']);

Route::get('/modules/{id}/lessons', [LessonController::class, 'modular']);
Route::get('/lessons/{id}', [LessonController::class, 'show']);
Route::post('/lessons', [LessonController::class, 'create']);
Route::put('/lessons/{id}', [LessonController::class, 'update']);
