<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class VerificationController extends Controller
{
    public function sendVerificationLink(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'البريد الإلكتروني مُفعّل بالفعل']);
        }

        $url = URL::signedRoute('verify.email', ['id' => $user->id]);

        Mail::to($user->email)->send(new VerifyEmail($url));

        return response()->json(['message' => 'تم إرسال رابط التحقق']);
    }

    public function verifyEmail(Request $request)
    {
        $user = User::find($request->id);

        if (!$user || $user->hasVerifiedEmail()) {
            return response()->json(['message' => 'رابط غير صالح أو البريد مفعل مسبقاً']);
        }

        $user->markEmailAsVerified();

        return response()->json(['message' => 'تم تفعيل البريد بنجاح']);
    }
}
