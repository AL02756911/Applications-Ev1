<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::get('/', [OrderController::class, 'publicSearch'])->name('home');
Route::post('/search', [OrderController::class, 'search'])->name('order.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management routes
    Route::resource('users', UserController::class);

    // Order management routes
    Route::resource('orders', OrderController::class);

    // Additional Order routes for status change and photo upload
    Route::post('/orders/{order}/change-status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
    Route::post('/orders/{order}/upload-photo', [OrderController::class, 'uploadPhoto'])->name('orders.uploadPhoto');

    // Archived orders and restore route
    Route::get('/orders-archived', [OrderController::class, 'archived'])->name('orders.archived');
    Route::post('/orders/{order}/restore', [OrderController::class, 'restore'])->name('orders.restore');
});
