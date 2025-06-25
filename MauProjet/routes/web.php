<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/annonces', function () {
    return view('admin.annonces.index');
})->name('admin.annonces.index');

Route::get('/admin/annonces/create', function () {
    return view('admin.annonces.create');
})->name('admin.annonces.create');

