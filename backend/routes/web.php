<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'redirectToGoogle'])->name('auth.login');
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
