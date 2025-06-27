<?php

use App\Http\Controllers\Admin\AnnonceController;
use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\CategorieController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('bien', BienController::class);
    Route::resource('categorie-bien', CategorieController::class)->parameters([
        'categorie-bien' => 'categorie'
    ]);
    Route::resource('annonce', AnnonceController::class);
});

Route::prefix('/')->name('client.')->group(function () {

    Route::get('/', function () {
        return ('welcome');
    })->name('home');
    
});
