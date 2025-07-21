<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroomSubjects()
    {
        return $this->hasMany(ClassroomSubjectTeacher::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
