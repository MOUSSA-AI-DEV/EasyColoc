<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/users/{user}/ban', [AdminDashboardController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{user}/unban', [AdminDashboardController::class, 'unban'])->name('users.unban');
    });