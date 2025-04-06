<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products',[ProductController::class,'lists'])->name('api.lists');
Route::get('/products/{id}',[ProductController::class,'getById'])->name('api.getById');
Route::post('/products', [ProductController::class, 'create'])->name('api.create');
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('api.update');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('api.delete');