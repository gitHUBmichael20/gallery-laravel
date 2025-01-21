<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::prefix('gallery')->group(function () {
    Route::get('/show', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/upload', [GalleryController::class, 'showtable'])->name('upload');
});