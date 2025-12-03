<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;

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
});

//Admin
Route::prefix('admin')->middleware(['auth', 'admincheck'])->group(function()
{
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('user', UserController::class)->names('admin.user');
    Route::resource('book', BookController::class)->names('admin.book');
});

