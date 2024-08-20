<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/gallery', function () {
    return Inertia::render('Gallery');
})->name('galley');
Route::get('/specials', function () {
    return Inertia::render('Specials');
})->name('specials');
Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');
Route::get('/book', function () {
    return Inertia::render('Book');
})->name('book');
Route::get('/events', function () {
    return Inertia::render('Events');
})->name('events');
Route::get('/shop', function () {
    return Inertia::render('Shop');
})->name('shop');
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('posts', PostController::class)->only('create', 'store');
    Route::resource('posts.comments', CommentController::class)->shallow()->only('store', 'update', 'destroy');
    Route::post('/likes/{type}/{id}', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes/{type}/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

Route::get('posts/{post}/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{category?}', [PostController::class, 'index'])->name('posts.index');
