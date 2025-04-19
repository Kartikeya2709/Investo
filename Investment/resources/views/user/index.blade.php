@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Users Summary</h2>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Investments ($)</th>
                    <th class="py-3 px-4 text-left">Expenses ($)</th>
                    <th class="py-3 px-4 text-left">Surplus/Deficit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersData as $user)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $user['name'] }}</td>
                        <td class="py-2 px-4">{{ $user['email'] }}</td>
                        <td class="py-2 px-4">${{ number_format($user['totalInvestments'], 2) }}</td>
                        <td class="py-2 px-4">${{ number_format($user['totalExpenses'], 2) }}</td>
                        <td class="py-2 px-4">
                            @if ($user['surplus'] > 0)
                                <span class="text-green-600 font-semibold">Surplus ${{ number_format($user['surplus'], 2) }}</span>
                            @elseif ($user['surplus'] < 0)
                                <span class="text-red-600 font-semibold">Deficit ${{ number_format(abs($user['surplus']), 2) }}</span>
                            @else
                                <span class="text-gray-600 font-semibold">Break-even</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
