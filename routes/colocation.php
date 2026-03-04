<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Colocation routes
    Route::resource('colocations', ColocationController::class);
    Route::post('colocations/{colocation}/leave', [ColocationController::class, 'leave'])->name('colocations.leave');
    Route::post('colocations/{colocation}/inactif', [ColocationController::class, 'inactif'])->name('colocations.inactif');

    // Expense routes
    Route::post('expenses/store/{colocation}', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // Category routes
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Invitation routes
    Route::post('invitations/{colocation}/store', [InvitationController::class, 'store'])->name('invitations.store');
    Route::post('invitations/{invitation}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('invitations/{invitation}/decline', [InvitationController::class, 'decline'])->name('invitations.decline');

    // Payment routes
    Route::post('payments/{payment}/mark-as-paid', [\App\Http\Controllers\PaymentController::class, 'markAsPaid'])->name('payments.markAsPaid');
});
