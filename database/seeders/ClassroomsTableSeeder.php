<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomsTableSeeder extends Seeder
{
    public function run()
    {
        $classrooms = [
            'الصف الأول',
            'الصف الثاني',
            'الصف الثالث',
            'الصف الرابع',
            'الصف الخامس',
            'الصف السادس',
        ];

        foreach ($classrooms as $name) {
            Classroom::firstOrCreate(['name' => $name]);
        }
    }
}