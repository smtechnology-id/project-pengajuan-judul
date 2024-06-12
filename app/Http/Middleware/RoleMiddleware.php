<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Redirect to login if user is not authenticated
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if the user has any of the required roles
        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request);
            }
        }

        // Redirect or abort if the user doesn't have the required role
        return abort(403, 'Unauthorized action.');
    }
}
