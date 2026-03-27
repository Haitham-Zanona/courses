<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth('student')->check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in to access the course.');
        }

        if (! auth('student')->user()->is_active) {
            auth('student')->logout();
            return redirect()->route('login')
                ->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}