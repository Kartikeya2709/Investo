<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Display a list of users (superadmin functionality).
     */
    public function showUsers()
    {
        // Only allow superadmins to view this page
        $this->authorize('viewAny', User::class); // This checks the superadmin permission
        
        $users = User::all(); // Get all users for the superadmin
        return view('superadmin.users', compact('users'));
    }

    /**
     * Delete a user (superadmin functionality).
     */
    public function deleteUser($id)
    {
        $this->authorize('delete', User::class); // This checks the superadmin permission
        
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.users')->with('status', 'User deleted successfully.');
    }
}
