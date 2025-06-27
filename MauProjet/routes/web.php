<?php

use App\Http\Controllers\Admin\AnnonceController;
use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('', [AdminHomeController::class, 'index']);
    Route::resource('bien', BienController::class);
    Route::resource('categorie-bien', CategorieController::class)->parameters([
        'categorie-bien' => 'categorie'
    ]);
    Route::resource('annonce', AnnonceController::class);
});

Route::prefix('/')->name('client.')->group(function () {
    Route::get('/', [ClientHomeController::class, 'index'])->name('home');
    Route::get('/contact', [ClientHomeController::class, 'contact'])->name('contact');
    Route::get('/annonces', [ClientHomeController::class, 'annonces'])->name('annonce');
});
