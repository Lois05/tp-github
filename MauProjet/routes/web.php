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
use App\Http\Controllers\Client\Locataire\DemandeController;
use App\Http\Controllers\Client\Locataire\LocationController;

/*
|--------------------------------------------------------------------------
| PARTIE PUBLIQUE – CLIENT (site vitrine LocaPlus)
|--------------------------------------------------------------------------
*/
Route::name('client.')->group(function () {
    Route::get('/', [ClientHomeController::class, 'index'])->name('home');
    Route::get('/contact', [ClientHomeController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [ClientHomeController::class, 'sendContact'])->name('contact.send');
    Route::get('/about', [ClientHomeController::class, 'about'])->name('about');

    // Annonces
    Route::get('/annonces', [ClientHomeController::class, 'annonces'])->name('annonces.index');
    Route::get('/annonces/{id}', [ClientHomeController::class, 'showAnnonce'])->name('annonces.show');
});

/*
|--------------------------------------------------------------------------
| PARTIE LOCATAIRE – Formulaires de demande de location
|--------------------------------------------------------------------------
*/
Route::prefix('locataire')->name('locataire.')->group(function () {
    // Demande de location
    Route::get('demande/create/{annonce}', [DemandeController::class, 'create'])->name('demande.create');
    Route::post('demande/store/{annonce}', [DemandeController::class, 'store'])->name('demande.store');

});



/*
|--------------------------------------------------------------------------
| PARTIE ADMIN – Back-office sécurisé
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');

    // Biens
    Route::resource('biens', BienController::class);
    Route::patch('biens/{bien}/toggle-etat', [BienController::class, 'toggleEtat'])->name('biens.toggleEtat');

    // Catégories
    Route::resource('categorie-bien', CategorieController::class)->parameters([
        'categorie-bien' => 'categorie'
    ]);

    // Annonces
    Route::resource('annonces', AnnonceController::class);

    // Avis
    Route::resource('avis', AvisController::class)->only(['index', 'show']);
    Route::patch('/avis/{avis}/toggle', [AvisController::class, 'toggle'])->name('avis.toggle');
    Route::get('/avis/masques', [AvisController::class, 'masques'])->name('avis.masques');

    // Utilisateurs
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggleBlock');
});

/*
|--------------------------------------------------------------------------
| PROFIL UTILISATEUR CONNECTÉ
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION (Breeze ou Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
