<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show'])->name('events.show');

    Route::get('/events/create', [\App\Http\Controllers\Sample\IndexController::class, 'create'])->name('events.create');
    Route::post('/events/store', [\App\Http\Controllers\Sample\IndexController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [\App\Http\Controllers\Sample\IndexController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'destroy'])->name('events.destroy');
});
