@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Expenses</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="py-2 px-4">Title</th>
                <th class="py-2 px-4">Category</th>
                <th class="py-2 px-4">Amount</th>
                <th class="py-2 px-4">Date</th>
                <th class="py-2 px-4">User</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td class="py-2 px-4">{{ $expense->title }}</td>
                <td class="py-2 px-4">{{ $expense->category }}</td>
                <td class="py-2 px-4">${{ number_format($expense->amount, 2) }}</td>
                <td class="py-2 px-4">{{ $expense->date->format('M d, Y') }}</td>
                <td class="py-2 px-4">{{ $expense->user->name }}</td>
                <td class="py-2 px-4">
                    <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" style="display:inline;">
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
        <a href="{{ route('expense.create') }}" class="bg-blue-800 text-white py-2 px-4 rounded hover:bg-blue-700">Add New Expense</a>
    </div>
</div>
@endsection
