<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttendanceNotificationMail;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Attendance::with('student')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'student_id' => 'required|exists:students,id',
        'date' => 'required|date',
        'status' => 'required|boolean',
    ]);

    $attendance = Attendance::create($request->all());

    $student = $attendance->student;
    $parent = $student->parent;

    // فقط إذا كان الطالب غائباً
    if (! $attendance->status && $parent) {
        // 1. حفظ إشعار في قاعدة البيانات
        Notification::create([
            'title' => 'تحذير: غياب الطالب',
            'message' => "الطالب {$student->name} غاب عن الحصة بتاريخ {$attendance->date}.",
            'type' => 'attendance',
            'student_id' => $student->id,
            'user_id' => $parent->id,
            'sent_at' => now(),
        ]);

        // 2. (اختياري) إرسال بريد إلكتروني
        Mail::to($parent->email)->send(new AttendanceNotificationMail($student, $attendance));
    }

    return response()->json($attendance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('student')->find($id);
        return $attendance ? response()->json($attendance) : response()->json(['message' => 'Not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
