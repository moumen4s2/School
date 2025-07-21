<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomSubjectTeacher>
 */
class ClassroomSubjectTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom_id' => rand(1, 10),
            'subject_id' => rand(1, 10),
            'teacher_id' => rand(1, 10),
        ];
    }
}
