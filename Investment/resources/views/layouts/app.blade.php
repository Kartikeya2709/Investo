<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Investment App') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    @yield('scripts')

    <!-- Sidebar -->
    <div class="flex">
    <div class="w-64 bg-blue-800 p-4 text-white h-screen">
        <h2 class="text-xl font-bold mb-6">Investment App</h2>
        <ul>
            <li><a href="{{ route('dashboard.index') }}" class="block py-2 px-4 hover:bg-blue-700">Dashboard</a></li>
            <li><a href="{{ route('investment.index') }}" class="block py-2 px-4 hover:bg-blue-700">Investments</a></li>
            <li><a href="{{ route('expense.index') }}" class="block py-2 px-4 hover:bg-blue-700">Expenses</a></li>

            @if(Auth::check() && Auth::user()->isSuperAdmin())
                <li><a href="{{ route('user.create') }}" class="block py-2 px-4 hover:bg-blue-700">Create User</a></li>
                <li><a href="{{ route('user.index') }}" class="block py-2 px-4 hover:bg-blue-700">Users</a></li>
            @endif

            <li><a href="{{ route('dashboard.summary') }}" class="block py-2 px-4 hover:bg-blue-700">Summary</a></li>
        </ul>
    </div>






        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Navbar -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold">Dashboard</h1>
                <div>
                    @if(Auth::check() && Auth::user())
                        <span class="text-gray-700"><b>Welcome, {{ strtoupper(Auth::user()->name) }}</b></span>
                    @else
                        <span class="text-gray-700">Welcome, Guest</span>
                    @endif
                </div>
                <div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-800 hover:text-blue-600">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Content Area -->
            @yield('content')
        </div>
    </div>

</body>
</html>
