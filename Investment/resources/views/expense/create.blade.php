@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-center custom-card-header">
                    <h3 class="mb-0">{{ __('Add New Expense') }}</h3>
                </div>

                <div class="card-body p-4 bg-light-subtle rounded-bottom">
                    <form action="{{ route('expense.store') }}" method="POST" class="expense-form">
                        @csrf
                        
                        <!-- User -->
                        <div class="form-floating mb-3">
                            <select name="user_id" class="form-select custom-input" required>
                                <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                            </select>
                            <label for="user_id">User</label>
                        </div>

                        <!-- Title -->
                        <div class="form-floating mb-3">
                            <input type="text" name="title" id="title" class="form-control custom-input @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Expense title" required>
                            <label for="title">Title</label>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-floating mb-3">
                            <input type="text" name="category" id="category" class="form-control custom-input @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="Category" required>
                            <label for="category">Category</label>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="form-floating mb-3">
                            <input type="number" name="amount" id="amount" step="0.01" class="form-control custom-input @error('amount') is-invalid @enderror" value="{{ old('amount') }}" placeholder="Amount" required>
                            <label for="amount">Amount</label>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="form-floating mb-4">
                            <input type="date" name="date" id="date" class="form-control custom-input @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                            <label for="date">Date</label>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-outline-secondary custom-btn">Reset</button>
                            <button type="submit" class="btn btn-primary custom-btn">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .custom-card-header {
        background: linear-gradient(135deg, #007bff, #00bcd4);
        color: white;
        padding: 20px;
        border-radius: 1rem 1rem 0 0;
    }

    .custom-input {
        border-radius: 0.75rem;
        padding: 0.75rem;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .custom-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .custom-btn {
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 0.5rem;
        transition: 0.3s ease;
    }

    .custom-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .expense-form {
        background: #f8f9fa;
        border-radius: 1rem;
    }

    .invalid-feedback {
        font-size: 0.9rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        opacity: 0.85;
        transform: scale(0.85) translateY(-1.5rem);
    }
</style>
@endsection
