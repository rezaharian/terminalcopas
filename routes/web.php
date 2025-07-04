<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| ROUTE PUBLIK (Tidak Perlu Login)
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [PublicController::class, 'index'])->name('home');

// Lihat detail postingan
Route::get('/posts/show/{id}-{slug}', [PublicController::class, 'post_show'])->name('posts.selengkapnya');

// Lihat postingan berdasarkan kategori
Route::get('/kategori/{slug}', [PublicController::class, 'kategori'])->name('posts.kategori');
Route::get('/teknologi/{slug}', [PublicController::class, 'teknologi'])->name('posts.teknologi');
Route::get('/tentang', function () {
    return view('public.tentang');
})->name('public.tentang');


/*
|--------------------------------------------------------------------------
| ROUTE KOMENTAR (AJAX) - Auth via Frontend, bukan middleware
|--------------------------------------------------------------------------
*/

// Tambah komentar utama
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

// Balas komentar
Route::post('/comments/reply/{comment}', [CommentController::class, 'reply'])->name('comments.reply');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN / AUTH - Perlu Login & Verifikasi
|--------------------------------------------------------------------------
*/

// Group middleware default
$adminMiddleware = [
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
];

// CRUD Users (prefix admin)
Route::middleware($adminMiddleware)
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    });

// Dashboard & Posts tanpa prefix, tetap admin only
Route::middleware($adminMiddleware)->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('posts', PostController::class);
});