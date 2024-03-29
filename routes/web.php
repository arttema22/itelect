<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::controller(ArticleController::class)
    ->name('articles.')
    ->prefix('articles')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{article:slug}', 'show')->name('show');
    });

Route::controller(ProductController::class)
    ->name('products.')
    ->prefix('products')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{product:slug}', 'show')->name('show');
    });
