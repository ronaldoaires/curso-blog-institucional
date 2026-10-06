<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\PostController;
use App\Http\Controllers\Site\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sobre', [PageController::class, 'about'])->name('about');

Route::get('/contato', [PageController::class, 'contact'])->name('contact');

// Posts
Route::get('/artigos', [PostController::class, 'index'])->name('posts.index');
Route::get('/artigos/{slug}', [PostController::class, 'show'])->name('posts.show');

// Categories
Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{slug}', [CategoryController::class, 'show'])->name('categories.show');