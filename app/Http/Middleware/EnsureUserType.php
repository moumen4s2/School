<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserType
{
    public function handle(Request $request, Closure $next, ...$types)
    {
        $user = Auth::user();

        if (! $user || ! in_array($user->type, $types)) {
            return response()->json([
                'message' => 'غير مصرح لك بالوصول إلى هذا المورد.'
            ], 403);
        }

        return $next($request);
    }
}
