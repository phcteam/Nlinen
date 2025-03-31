<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/home')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        if ($user && in_array($user->PmID, $roles)) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
    }
}
