<?php

use App\Http\Controllers\Admin\BienController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->name('admin.')->group(function () {

    Route::resource('bien', BienController::class);

});

Route::prefix('/')->name('client.')->group(function () {

    Route::get('/', function () {
        return ('welcome');
    })->name('home');

});
