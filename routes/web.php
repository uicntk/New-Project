<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

if (!Auth::check()) {
    Route::inertia('/login', 'Auth/Login');
}

Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return Inertia::render('Home');
    });
    
    Route::get('/about', function () {
        return inertia('About');
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('profile')->group(function () {
        Route::inertia('/', 'Profile');
    });
});


Route::middleware('guest')->group(function(){
    Route::inertia('/register', 'Auth/Register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', ['as' => 'login', AuthController::class, 'login'])->name('register');
});