<?php

use App\Http\Controllers\PayPalController;
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

Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.success');
Route::get('paypal/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.cancel');

// صفحة الشكر بعد نجاح الدفع
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');

// صفحة الكورس المحمية
Route::get('/course', [StudentAuthController::class, 'course'])
    ->middleware('student.auth')
    ->name('course');

Route::get('/checkout', [App\Http\Controllers\PayPalController::class, 'index'])->name('checkout');

require __DIR__ . '/auth.php';