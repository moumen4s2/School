<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // البحث عن المستخدم
        $user = User::where('email', $request->email)->first();

        // التحقق من وجود المستخدم وكلمة المرور
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        // إنشاء التوكن يدويًا باستخدام Sanctum
        $plainTextToken = $user->createToken('auth_token')->plainTextToken;

        // إرجاع الاستجابة
        return response()->json([
            'access_token' => $plainTextToken,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type,
                'phone' => $user->phone,
            ]
        ]);
    }
}