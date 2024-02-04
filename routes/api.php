<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Маршруты для студентов
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

// Маршруты для классов
Route::get('/classrooms', [ClassRoomController::class, 'index']);
Route::get('/classrooms/{id}', [ClassRoomController::class, 'show']);
Route::get('/classrooms/{id}/study-plan', [ClassRoomController::class, 'getPlan']);
Route::post('/classrooms/{id}/study-plan', [ClassRoomController::class, 'createOrUpdatePlan']);
Route::post('/classrooms', [ClassRoomController::class, 'store']);
Route::put('/classrooms/{id}', [ClassRoomController::class, 'update']);
Route::delete('/classrooms/{id}', [ClassRoomController::class, 'destroy']);

// Маршруты для лекций
Route::get('/lectures', [LectureController::class, 'index']);
Route::get('/lectures/{id}', [LectureController::class, 'show']);
Route::post('/lectures', [LectureController::class, 'store']);
Route::put('/lectures/{id}', [LectureController::class, 'update']);
Route::delete('/lectures/{id}', [LectureController::class, 'destroy']);
