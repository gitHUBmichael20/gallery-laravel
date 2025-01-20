<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\galleryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/gallery-store', [galleryController::class, 'store'])->name('gallery-store');
Route::delete('/gallery-destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery-destroy');
Route::patch('/gallery-update/{id}', [GalleryController::class, 'update'])->name('gallery-update');