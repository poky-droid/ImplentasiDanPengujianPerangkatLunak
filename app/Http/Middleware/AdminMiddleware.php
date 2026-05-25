<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if user is admin (email ends with @example.com or has admin role)
        if ($request->user()->email === 'admin@example.com') {
            return $next($request);
        }

        // If not admin, redirect to login or show unauthorized
        abort(403, 'Unauthorized access. Admin only.');
    }
}
