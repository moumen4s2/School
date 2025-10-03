<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            'الرياضيات',
            'اللغة العربية',
            'العلوم',
            'اللغة الإنجليزية',
            'التاريخ',
            'الجغرافيا',
            'التربية الإسلامية',
            'الرسم',
            'الموسيقى',
        ];

        foreach ($subjects as $name) {
            Subject::firstOrCreate(['name' => $name]);
        }
    }
}