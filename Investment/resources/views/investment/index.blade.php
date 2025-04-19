@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Investments</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Amount Invested</th>
                <th class="py-2 px-4">Annual Return (%)</th>
                <th class="py-2 px-4">Investment Date</th>
                <th class="py-2 px-4">Compounding</th>
                <th class="py-2 px-4">User</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($investments as $investment)
            <tr>
                <td class="py-2 px-4">{{ $investment->name }}</td>
                <td class="py-2 px-4">${{ number_format($investment->amount_invested, 2) }}</td>
                <td class="py-2 px-4">{{ $investment->annual_return_percentage }}%</td>
                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($investment->investment_date)->format('M d, Y') }}</td>
                <td class="py-2 px-4 capitalize">{{ $investment->compounding }}</td>
                <td class="py-2 px-4">{{ $investment->user->name }}</td>
                <td class="py-2 px-4">
                    <form action="{{ route('investment.destroy', $investment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('investment.create') }}" class="bg-blue-800 text-white py-2 px-4 rounded hover:bg-blue-700">Add New Investment</a>
    </div>
</div>
@endsection
