<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\User;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::all();
        return view('investment.index', compact('investments'));
    }

    public function create()
    {
        $users = User::all(); // Show all users for investment
        return view('investment.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'amount_invested' => 'required|numeric',
            'annual_return_percentage' => 'required|numeric',
            'investment_date' => 'required|date',
            'compounding' => 'required|in:monthly,annually',
        ]);

        Investment::create($validated);

        return redirect()->route('investment.index');
    }

    public function destroy($id)
    {
        // Find the expense by its ID
        $expense = Investment::findOrFail($id);
        
        // Delete the expense
        $expense->delete();

        // Redirect to the expense index page after deletion
        return redirect()->route('investment.index')->with('success', 'Expense deleted successfully!');
    }
}
