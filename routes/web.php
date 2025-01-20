<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/upload', [GalleryController::class, 'showtable'])->name('upload');