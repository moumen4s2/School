<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * عرض جميع المستخدمين (مصفاة حسب النوع)
     */
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('type')) {
            $users->where('type', $request->type);
        }

        return response()->json($users->select('id', 'name', 'email', 'phone', 'type', 'created_at')->get());
    }

    /**
     * إنشاء مستخدم جديد
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'type' => 'required|in:student,teacher,admin',
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => Hash::make('temp123'),
        ]);

        return response()->json([
            'message' => 'تم إنشاء الحساب بنجاح',
            'user' => $user
        ], 201);
    }
    /**
     * تحديث مستخدم
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'phone' => 'sometimes|required|string|unique:users,phone,' . $id,
            'type' => 'sometimes|required|in:student,teacher,admin',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'type'));

        return response()->json([
            'message' => 'تم تحديث الحساب بنجاح',
            'user' => $user->fresh(['id', 'name', 'email', 'phone', 'type'])
        ]);
    }

    /**
     * حذف مستخدم (عدا المديرين)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->type === 'admin') {
            return response()->json([
                'message' => 'لا يمكن حذف حساب مدير'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'تم حذف الحساب بنجاح'
        ]);
    }
}