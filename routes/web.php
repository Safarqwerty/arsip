<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceDocumentController;

Route::get('/', function () {
    return view('welcome');
});

// Route dashboard
Route::middleware(['auth'])->get('/dashboard', [FinanceDocumentController::class, 'dashboard'])->name('dashboard');

// Route resource untuk finance-documents dengan middleware auth dan verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('finance-documents', FinanceDocumentController::class);

    Route::resource('categories', CategoryController::class);
    // Route untuk mendownload file
    Route::get('finance-documents/{financeDocument}/download', [FinanceDocumentController::class, 'download'])
        ->name('finance-documents.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
