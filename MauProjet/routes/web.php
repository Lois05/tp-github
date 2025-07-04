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


/*
|--------------------------------------------------------------------------
| PARTIE PUBLIQUE – CLIENT (site vitrine LocaPlus)
|--------------------------------------------------------------------------
*/
Route::name('client.')->group(function () {
    // Accueil
    Route::get('/', [ClientHomeController::class, 'index'])->name('home');

    // Page Contact
    Route::get('/contact', [ClientHomeController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [ClientHomeController::class, 'sendContact'])->name('contact.send');
    // Page A propos
    Route::get('/about', [ClientHomeController::class, 'about'])->name('about');

    // Liste des annonces
    Route::get('/annonces', [ClientHomeController::class, 'annonces'])->name('annonces.index');

    // Détail d’une annonce
    Route::get('/annonces/{id}', [ClientHomeController::class, 'showAnnonce'])->name('annonces.show');
    Route::get('location/create/{id}', [LocationController::class, 'create'])->name('location.create');
});
//Location
    Route::prefix('locataire')->name('locataire.')->group(function () {
    Route::get('demande/create/{annonce}', [DemandeController::class, 'create'])->name('demande.create');
    Route::post('demande/store', [DemandeController::class, 'store'])->name('demande.store');
});


/*
|--------------------------------------------------------------------------
| PARTIE ADMIN (back-office sécurisé de LocaPlus)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Tableau de bord admin
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');

    // Gestion des biens
    Route::resource('biens', BienController::class);
    Route::patch('biens/{bien}/toggle-etat', [BienController::class, 'toggleEtat'])->name('biens.toggleEtat');

    // Catégories de biens
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
| PROFIL UTILISATEUR CONNECTÉ (via Breeze ou Jetstream)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // à adapter selon ton layout
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ROUTES D'AUTHENTIFICATION (automatiques de Breeze ou Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
