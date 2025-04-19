<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('expense.index', compact('expenses'));
    }

    public function create()
    {
        $users = User::all(); // Show all users for expense
        return view('expense.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Expense::create($validated);

        return redirect()->route('expense.index');
    }

    public function destroy($id)
    {
        // Find the expense by its ID
        $expense = Expense::findOrFail($id);
        
        // Delete the expense
        $expense->delete();

        // Redirect to the expense index page after deletion
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully!');
    }
}
