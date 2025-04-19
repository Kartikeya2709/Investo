<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/register', [UserController::class, 'create'])->name('user.create');
Route::post('/register', [UserController::class, 'store'])->name('user.store');


Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user', [UserController::class, 'store'])->name('user.store');


Route::get('/', function () {
    return redirect()->route('login');
});


// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('newregisterpage', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('newregisterpage', [RegisterController::class, 'register']);
Route::get('/dashboard/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');

Route::middleware(['auth.only'])->group(function () {
    Route::resource('investment', InvestmentController::class);
Route::resource('expense', ExpenseController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');
});


