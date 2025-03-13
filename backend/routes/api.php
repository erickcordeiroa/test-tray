<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::put('/register', [UserController::class, 'update'])->name('auth.register');
Route::get('/listar', [UserController::class, 'index']);
Route::get('/search', [UserController::class, 'search']);
