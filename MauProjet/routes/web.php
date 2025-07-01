<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AnnonceController,
    AvisController,
    BienController,
    CategorieController,
    HomeController as AdminHomeController,
    UserController
};
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\ProfileController;

// -------------------- Routes ADMIN (sans sécurité) --------------------
Route::prefix('admin')->name('admin.')->group(function () {
    // Tableau de bord admin
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');
 // <-- ajouter name('index')
    Route::resource('biens', BienController::class);
    Route::resource('categorie-bien', CategorieController::class)->parameters(['categorie-bien' => 'categorie']);
    Route::resource('annonces', AnnonceController::class);
    Route::resource('avis', AvisController::class)->only(['index', 'show', 'masque']);
    Route::patch('/avis/{avis}/toggle', [AvisController::class, 'toggleMasque'])->name('admin.avis.toggle');
    Route::get('/avis/masque', [AvisController::class, 'masque'])->name('admin.avis.masque');

    // Route spécifique pour bloquer/débloquer un utilisateur (PATCH)
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggleBlock');
});

// -------------------- Routes CLIENT PUBLIQUES --------------------
Route::prefix('/')->name('client.')->group(function () {
    Route::get('/', [ClientHomeController::class, 'index'])->name('home');
    Route::get('/contact', [ClientHomeController::class, 'contact'])->name('contact');
    Route::get('/annonces', [ClientHomeController::class, 'annonces'])->name('annonces');
});

// -------------------- Routes AUTHENTIFIÉES --------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -------------------- Auth (Breeze/Laravel Auth) --------------------
require __DIR__.'/auth.php';
