<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;


/**
 * -------------------------------------------------------------
 *  ROOT ROUTE
 *  Redirects the homepage ('/') to the departments index.
 *  This ensures users land directly on the list of departments
 *  when visiting the base URL (http://127.0.0.1:8000/).
 * -------------------------------------------------------------
 */
Route::get('/', fn () => redirect()->route('departments.index'));


/**
 * -------------------------------------------------------------
 *  DEPARTMENTS ROUTES
 *  Resource controller: DepartmentController
 *
 *  Available routes:
 *   • GET /departments          → index()   → Show all departments
 *   • GET /departments/{id}     → show()    → Show a single department
 *
 *  
 *  -->  only 'index' and 'show'
 *   since department creation/editing isn't part of this module.
 * -------------------------------------------------------------
 */
Route::resource('departments', DepartmentController::class);

/**
 * -------------------------------------------------------------
 *  PRODUCTS ROUTES
 *  Resource controller: ProductController
 *
 *  Available routes (full CRUD):
 *   • GET /products              → index()    → List all products
 *   • GET /products/create       → create()   → Show new product form
 *   • POST /products             → store()    → Save new product
 *   • GET /products/{product}    → show()     → Show single product
 *   • GET /products/{product}/edit → edit()   → Show edit form
 *   • PUT /products/{product}    → update()   → Update existing product
 *   • DELETE /products/{product} → destroy()  → Delete a product
 *
 *  
 *   This connects all CRUD functionality for the products section
 *   
 * -------------------------------------------------------------
 */

Route::resource('departments.products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');   // Dashboard route with auth and verification middleware

// Profile management routes within auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');   
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
