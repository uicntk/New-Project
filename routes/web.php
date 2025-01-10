<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use App\Models\User;

Route::middleware('auth')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('home');
    
    Route::inertia('/about', 'About')->name('about');

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/editpass', [ProfileController::class, 'editpass'])->name('profile.editpass');
    });
});


Route::middleware('guest')->group(function(){
    Route::inertia('/register', 'Auth/Register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', ['as' => 'login', AuthController::class, 'login'])->name('register');
});