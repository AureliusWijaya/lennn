<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\LangMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(LangMiddleware::class);
Route::get('/register', [UserController::class, 'indexRegister'])->name('register.page');
Route::get('/login', [UserController::class, 'indexLogin'])->name('login.page');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get(
    '/lang/{locale}',
    function ($locale) {
        if (in_array($locale, ['en', 'id'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
)->name('lang.switch');

Route::middleware([isAdmin::class, LangMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/create-article', [ProductController::class, 'index'])->name('article.create');
    Route::post('/store-article', [ProductController::class, 'store'])->name('article.store');

    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}', [ProductController::class, 'delete'])->name('product.delete');
});



Route::get('/search/advanced', [SearchController::class, 'advancedSearch'])->name('search.advanced');
Route::get('/detail/{id}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::post('/purchase/{productId}', [ProductController::class, 'purchase'])->name('purchase');

Route::get('/order-history', [OrderController::class, 'index'])->name('order.history');