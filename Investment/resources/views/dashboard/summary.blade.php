@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-4">Financial Summary</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Investment -->
            <div class="bg-blue-100 p-4 rounded shadow text-center">
                <h3 class="text-lg font-semibold text-blue-800">Total Investment</h3>
                <p class="text-2xl font-bold text-blue-900">${{ number_format($totalInvestments, 2) }}</p>
            </div>

            <!-- Total Expense -->
            <div class="bg-red-100 p-4 rounded shadow text-center">
                <h3 class="text-lg font-semibold text-red-800">Total Expense</h3>
                <p class="text-2xl font-bold text-red-900">${{ number_format($totalExpenses, 2) }}</p>
            </div>

            <!-- Net Savings -->
            <div class="bg-green-100 p-4 rounded shadow text-center">
                <h3 class="text-lg font-semibold text-green-800">Net Savings</h3>
                @php $net = $totalInvestments - $totalExpenses; @endphp
                <p class="text-2xl font-bold {{ $net >= 0 ? 'text-green-900' : 'text-red-900' }}">
                    ${{ number_format($net, 2) }}
                </p>
                <p class="mt-1 text-sm font-medium">
                    @if ($net > 0)
                        <span class="text-green-700">Surplus</span>
                    @elseif ($net < 0)
                        <span class="text-red-700">Deficit</span>
                    @else
                        <span class="text-gray-700">Break-even</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- AI Insight -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-2">AI Insight</h3>
        <p class="text-gray-600 italic">{{ $aiInsight }}</p>
    </div>
</div>
@endsection
