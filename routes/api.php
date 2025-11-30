<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 // Protected routes for departments and products authenticated via Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('departments', DepartmentController::class);

    Route::apiResource('products', ProductController::class);

});
