<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming login request.
     */
    public function login(Request $request)
    {
        // Validate the incoming login request
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt($validated)) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();
    
            // Check if the authenticated user is a super admin
            // if (Auth::user()->isSuperAdmin()) {
            //     // Redirect to super admin dashboard if the user is a superadmin
            //     return redirect()->route('dashboard.index'); // Adjust the route if necessary
            // }
    
            // Redirect to regular user dashboard if not a superadmin
            return redirect()->route('dashboard.index'); // Adjust the route for regular users
        }
    
        // If authentication fails, throw a validation error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }


    /**
     * Logout the user and redirect.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
