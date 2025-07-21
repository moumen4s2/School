<?php

use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassroomSubjectTeacherController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\ScheduleController;




Route::apiResource('users', UserController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('classroom-subject-teachers', ClassroomSubjectTeacherController::class);
Route::apiResource('attendances', AttendanceController::class);
Route::apiResource('grades', GradeController::class);
Route::apiResource('schedules', ScheduleController::class);

Route::prefix('api')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
});