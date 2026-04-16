<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('departments.index'));

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Departments - protected write routes
    Route::resource('departments', DepartmentController::class)->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ]);

    // Products - protected write routes
    Route::resource('departments.products', ProductController::class)->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ]);
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::resource('departments', DepartmentController::class)->only([
    'index',
    'show',
]);

Route::resource('departments.products', ProductController::class)->only([
    'index',
    'show',
]);

require __DIR__.'/auth.php';