<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'مدير المدرسة',
            'email' => 'admin@school.com',
            'phone' => '+963999123456',
            'type' => 'admin',
            'password' => Hash::make('password'), // كلمة مرور معروفة
        ]);
    }
}