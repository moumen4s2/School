<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::with('user', 'classroom')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('user', 'classroom')->find($id);
        return $student ? response()->json($student) : response()->json(['message' => 'Not found'], 404);
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
    public function dashboard(Request $request)
    {
        $user = $request->user();

    // تأكد أن المستخدم طالب
        if ($user->type !== 'student') {
            return response()->json(['message' => 'غير مصرح'], 403);
        }

        $student = Student::with([
            'classroom',
            'grades.subject',
            'attendances',
            'comments.teacher'
        ])->findOrFail($user->student_id);

        return response()->json([
            'student' => $student,
            'grades' => $student->grades,
            'attendance' => $student->attendances,
            'comments' => $student->comments,
        ]);
    }
}
