<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)
    ->as('category.')
    ->prefix('/category')
    ->group(function () {
        Route::get('/', 'categories')->name('categories');
        Route::post('/store', 'store')->name('store');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

Route::controller(ProductController::class)
    ->as('product.')
    ->prefix('/product')
    ->group(function () {
        Route::get('/', 'products')->name('products');
        Route::post('/store', 'store')->name('store');
        Route::post('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');

        // product features
        Route::post('/{productId}/feature/store', 'storeFeature')->name('storeFeature');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
