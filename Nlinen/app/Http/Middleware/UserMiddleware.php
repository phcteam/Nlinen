<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user()->PmID == 2) {

            return $next($request);
        }

        return redirect()->route('home')->with('error', "You don't have user access");
    }
}
