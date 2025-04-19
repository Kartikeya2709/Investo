<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        // Check if user is super admin
        if ($user->isSuperAdmin()) {
            // Show data for all users
            $investmentLabels = Investment::pluck('name');
            $investmentData = Investment::pluck('amount_invested');
            $totalInvestments = Investment::sum('amount_invested');
    
            $expenseLabels = Expense::pluck('category');
            $expenseData = Expense::pluck('amount');
            $totalExpenses = Expense::sum('amount');
    
            $monthlyExpenses = DB::table('expenses')
                ->selectRaw("MONTH(date) as month_num, DATE_FORMAT(date, '%M') as month, SUM(amount) as total")
                ->groupByRaw("MONTH(date), DATE_FORMAT(date, '%M')")
                ->orderByRaw("MONTH(date)")
                ->get();


                $monthlyLabels = $monthlyExpenses->pluck('month');
                $monthlyTotals = $monthlyExpenses->pluck('total');
                $netSavings = $totalInvestments - $totalExpenses;
                $aiInsight = "You’ve saved $" . number_format($netSavings, 2) . " overall. Keep tracking your investments and expenses to improve your financial health.";
        } else {
            // Filter data by logged-in user ID
            $userId = $user->id;
    
            $investmentLabels = Investment::where('user_id', $userId)->pluck('name');
            $investmentData = Investment::where('user_id', $userId)->pluck('amount_invested');
            $totalInvestments = Investment::where('user_id', $userId)->sum('amount_invested');
    
            $expenseLabels = Expense::where('user_id', $userId)->pluck('category');
            $expenseData = Expense::where('user_id', $userId)->pluck('amount');
            $totalExpenses = Expense::where('user_id', $userId)->sum('amount');
    
            $monthlyExpenses = DB::table('expenses')
                ->where('user_id', $userId)
                ->selectRaw("MONTH(date) as month_num, DATE_FORMAT(date, '%M') as month, SUM(amount) as total")
                ->groupByRaw("MONTH(date), DATE_FORMAT(date, '%M')")
                ->orderByRaw("MONTH(date)")
                ->get();

                $monthlyLabels = $monthlyExpenses->pluck('month');
                $monthlyTotals = $monthlyExpenses->pluck('total');
                $netSavings = $totalInvestments - $totalExpenses;
                $aiInsight = "You’ve saved $" . number_format($netSavings, 2) . " overall. Keep tracking your investments and expenses to improve your financial health.";
        }
        
        // dd($user->isSuperAdmin());
       
       
    
       
       
    
        return view('dashboard.index', compact(
            'investmentLabels',
            'investmentData',
            'expenseLabels',
            'expenseData',
            'totalInvestments',
            'totalExpenses',
            'monthlyLabels',
            'monthlyTotals',
            'netSavings',
            'aiInsight'
        ));
    }
    
    
    public function summary()
    {
        $userId = auth()->id();
    
        $totalInvestments = Investment::where('user_id', $userId)->sum('amount_invested');
        $totalExpenses = Expense::where('user_id', $userId)->sum('amount');
        $netSavings = $totalInvestments - $totalExpenses;
    
        $aiInsight = "You’ve saved $" . number_format($netSavings, 2) . " overall. Keep tracking your investments and expenses to improve your financial health.";
    
        return view('dashboard.summary', compact(
            'totalInvestments',
            'totalExpenses',
            'netSavings',
            'aiInsight'
        ));
    }
    
}
