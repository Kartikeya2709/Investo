<?php
namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EnsureSuperAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && Auth::user()->isSuperAdmin()) {
            return $next($request);
        }

        return redirect('/'); // Redirect if not a superadmin
    }
}
