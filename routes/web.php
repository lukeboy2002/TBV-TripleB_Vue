<?php

use App\Http\Controllers\CommentController;
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

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

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
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});
