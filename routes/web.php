<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\BookMemberController;
use App\Http\Controllers\Member\LoanController as MemberLoanController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

//Auth
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Member
Route::prefix('Anggota')->middleware(['auth', 'membercheck'])->group(function()
{
    Route::get('dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('book', [BookMemberController::class, 'index'])->name('member.book.index');
    Route::get('book/{id}', [BookMemberController::class, 'show'])->name('member.book.show');
    Route::get('loan', [MemberLoanController::class, 'index'])->name('member.loan.index');
    Route::post('loan/store', [MemberLoanController::class, 'store'])->name('member.loan.store');
    Route::post('loan/return/{id}', [MemberLoanController::class, 'returnBook'])->name('member.loan.return');
});

//Admin
Route::prefix('admin')->middleware(['auth', 'admincheck'])->group(function()
{
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('user', UserController::class)->names('admin.user');
    Route::resource('book', BookController::class)->names('admin.book');
    Route::get('loan', [AdminLoanController::class, 'index'])->name('admin.loan.index');
    Route::post('loan/{id}/approve', [AdminLoanController::class, 'approve'])->name('admin.loan.approve');
    Route::post('loan/{id}/reject', [AdminLoanController::class, 'reject'])->name('admin.loan.reject');
});

