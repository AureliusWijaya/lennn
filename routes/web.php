<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\LangMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(LangMiddleware::class)->group(function () {
    Route::get('/', [ArticleController::class, 'showAll'])->name('home');
});


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
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});


Route::get('/create-article', [ArticleController::class, 'index'])->name('article.create');
Route::post('/store-article', [ArticleController::class, 'store'])->name('article.store');

Route::get('article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::put('article/{id}', [ArticleController::class, 'update'])->name('article.update');

