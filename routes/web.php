<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class)->names('admin.user');
Route::resource('book', BookController::class)->names('admin.book');
