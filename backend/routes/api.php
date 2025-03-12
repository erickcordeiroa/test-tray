<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'store'])->name('auth.register');
Route::get('/listar', [AuthController::class, 'listar']);
