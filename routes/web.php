<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login
Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login');
Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');

// صفحة الكورس المحمية
Route::get('/course', [StudentAuthController::class, 'course'])
    ->middleware('student.auth')
    ->name('course');

require __DIR__ . '/auth.php';