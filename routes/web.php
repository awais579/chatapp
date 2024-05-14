<?php

use App\Http\Controllers\messageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [userController::class, 'getUsers'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/send_message', [messageController::class, 'sendMessage'])->middleware(['auth', 'verified'])->name('sendMessage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
