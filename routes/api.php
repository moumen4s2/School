<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\AuthController;
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
use App\Http\Controllers\Api\NotificationController;




Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users',UserController::class);
    Route::apiResource('students',StudentController::class);
    Route::apiResource('teachers',TeacherController::class);
    Route::apiResource('classrooms',ClassroomController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('classroom-subject-teachers',ClassroomSubjectTeacherController::class);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
});
// Password Reset
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

// Email Verification
Route::post('/email/verify/send', [VerificationController::class, 'sendVerificationEmail']);
Route::get('/email/verify/{id}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/email/verify/send', [VerificationController::class, 'sendVerificationEmail']);
});

Route::get('/email/verify/{id}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');

Route::middleware(['auth:sanctum', 'role:admin,teacher'])->group(function () {
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('grades',GradeController::class);
    Route::apiResource('schedules', ScheduleController::class);
});

// الطلاب يمكنهم فقط قراءة البيانات
Route::middleware(['auth:sanctum', 'role:admin,teacher,student'])->group(function () {
    Route::get('/students', [App\Http\Controllers\Api\StudentController::class, 'index']);
    Route::get('/students/{id}', [App\Http\Controllers\Api\StudentController::class, 'show']);
});

// منع الطلاب من الإنشاء أو التعديل
Route::middleware(['auth:sanctum', 'role:admin,teacher'])->group(function () {
    Route::post('/students', [App\Http\Controllers\Api\StudentController::class, 'store']);
    Route::put('/students/{id}', [App\Http\Controllers\Api\StudentController::class, 'update']);
    Route::delete('/students/{id}', [App\Http\Controllers\Api\StudentController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);
});