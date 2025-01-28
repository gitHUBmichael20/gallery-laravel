<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

Route::get('/', [GalleryController::class, 'index'])
    ->name('gallery');

Route::prefix('gallery')->group(function () {
    Route::get('/show', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/upload', [GalleryController::class, 'showtable'])->name('upload');
    Route::get('/{id}', [GalleryController::class, 'show'])->name('articles.show');
});
