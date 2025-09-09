<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Grade::with('student', 'subject')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $grade = Grade::create($request->all());

    // إيجاد ولي أمر الطالب
    $student = $grade->student;
    $parent = $student->parent;

    if ($parent) {
        Notification::create([
            'title' => 'تم إدخال درجة جديدة',
            'message' => "تم إدخال درجة {$grade->score} في مادة {$grade->subject->name} للطالب {$student->name}",
            'type' => 'grade',
            'student_id' => $student->id,
            'user_id' => $parent->id,
            'sent_at' => now(),
        ]);
    }

    return response()->json($grade, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::with('student', 'subject')->find($id);
        return $grade ? response()->json($grade) : response()->json(['message' => 'Not found'], 404);
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
