<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\galleryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::prefix('/gallery')->group(function () {
    Route::post('/store', [galleryController::class, 'store'])->name('gallery-store');
    Route::delete('/destroy', [GalleryController::class, 'destroy'])->name('gallery-destroy');
    Route::patch('/update/{id}', [GalleryController::class, 'update'])->name('gallery-update');
});
