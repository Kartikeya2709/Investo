@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-center custom-card-header">
                    <h3 class="mb-0">{{ __('Add New Investment') }}</h3>
                </div>

                <div class="card-body p-4 bg-light-subtle rounded-bottom">
                    <form action="{{ route('investment.store') }}" method="POST" class="investment-form">
                        @csrf
                        
                        <!-- User -->
                        <div class="form-floating mb-3">
                            <select name="user_id" class="form-select custom-input" required>
                                <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                            </select>
                            <label for="user_id">User</label>
                        </div>

                        <!-- Investment Name -->
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id="name" class="form-control custom-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Investment Name" required>
                            <label for="name">Investment Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount Invested -->
                        <div class="form-floating mb-3">
                            <input type="number" name="amount_invested" id="amount_invested" step="0.01" class="form-control custom-input @error('amount_invested') is-invalid @enderror" value="{{ old('amount_invested') }}" placeholder="Amount Invested" required>
                            <label for="amount_invested">Amount Invested</label>
                            @error('amount_invested')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Annual Return Percentage -->
                        <div class="form-floating mb-3">
                            <input type="number" name="annual_return_percentage" id="annual_return_percentage" step="0.01" class="form-control custom-input @error('annual_return_percentage') is-invalid @enderror" value="{{ old('annual_return_percentage') }}" placeholder="Annual Return %" required>
                            <label for="annual_return_percentage">Annual Return %</label>
                            @error('annual_return_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Investment Date -->
                        <div class="form-floating mb-3">
                            <input type="date" name="investment_date" id="investment_date" class="form-control custom-input @error('investment_date') is-invalid @enderror" value="{{ old('investment_date') }}" required>
                            <label for="investment_date">Investment Date</label>
                            @error('investment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Compounding -->
                        <div class="form-floating mb-4">
                            <select name="compounding" class="form-select custom-input" required>
                                <option value="monthly" {{ old('compounding') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="annually" {{ old('compounding') == 'annually' ? 'selected' : '' }}>Annually</option>
                            </select>
                            <label for="compounding">Compounding</label>
                            @error('compounding')
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

    .investment-form {
        background: #f8f9fa;
        border-radius: 1rem;
    }

    .invalid-feedback {
        font-size: 0.9rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        opacity: 0.85;
        transform: scale(0.85) translateY(-1.5rem);
    }
</style>
@endsection
