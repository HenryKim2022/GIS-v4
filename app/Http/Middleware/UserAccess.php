<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if (auth()->user()->type == $userType) {
            // if (auth()->check() && auth()->user()->type == $userType) {
            return $next($request);
        }
        return response()->json(['You are not authorized to access this page. Please login first!']);
    }

}
