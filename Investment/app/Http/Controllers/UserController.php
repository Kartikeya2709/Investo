<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['investments', 'expenses'])->get();

        $usersData = $users->map(function ($user) {
            $totalInvestments = $user->investments->sum('amount_invested');
            $totalExpenses = $user->expenses->sum('amount');
            $surplus = $totalInvestments - $totalExpenses;
    
            return [
                'name' => $user->name,
                'email' => $user->email,
                'totalInvestments' => $totalInvestments,
                'totalExpenses' => $totalExpenses,
                'surplus' => $surplus,
            ];
        });
    
        return view('user.index', compact('usersData'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('login');
    }
}
