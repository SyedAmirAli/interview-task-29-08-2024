<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::prefix('/api')->as('api.')->group(function () {
//     Route::prefix('/category')->as('category.')->controller(CategoryController::class)->group(function () {
//         Route::get('/', 'categories')->name('categories');
//     });
// });

Route::view('/{any}', 'welcome')->where('any', '.*');
