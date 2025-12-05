<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
