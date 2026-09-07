<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserTagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class);

    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends.index');
    Route::get('/friends/search', [FriendshipController::class, 'search'])->name('friends.search');
    Route::post('/friends/{user}', [FriendshipController::class, 'store'])->name('friends.store');
    Route::patch('/friends/{friendship}/accept', [FriendshipController::class, 'accept'])->name('friends.accept');
    Route::patch('/friends/{friendship}/reject', [FriendshipController::class, 'reject'])->name('friends.reject');
    Route::delete('/friends/{friendship}', [FriendshipController::class, 'destroy'])->name('friends.destroy');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::post('/user_tags', [UserTagController::class, 'store'])->name('user_tags.store');
    Route::delete('/user_tags/{userTag}', [UserTagController::class, 'destroy'])->name('user_tags.destroy');

    Route::resource('/albums', AlbumController::class);
});

require __DIR__.'/auth.php';
