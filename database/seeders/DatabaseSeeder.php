<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء حساب المدير
        \App\Models\User::create([
            'name' => 'مدير المدرسة',
            'email' => 'admin@school.com',
            'phone' => '+963999123456',
            'type' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // 2. إدخال الصفوف
        $this->call(ClassroomsTableSeeder::class);

        // 3. إدخال المواد
        $this->call(SubjectsTableSeeder::class);

        // ❌ لا تُدخل طلاب أو معلمين بعد — سيُنشأون من لوحة التحكم
    }
}