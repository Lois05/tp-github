<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AnnonceController,
    AvisController,
    BienController,
    CategorieController,
    HomeController as AdminHomeController,
    UserController,
    StatistiqueController,
    SignalementController
};
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\Locataire\DemandeController as LocataireDemandeController;
use App\Http\Controllers\Client\AnnonceController as ClientAnnonceController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\Proprietaire\ProprietaireAnnonceController;
use App\Http\Controllers\Client\Proprietaire\ProprietaireDemandeController;
use App\Http\Controllers\Client\PortefeuilleController;
use App\Http\Controllers\Client\MonProfilController;



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
    Route::put('/annonces/{annonce}/valider', [AnnonceController::class, 'valider'])->name('annonces.valider');
    Route::put('/annonces/{annonce}/rejeter', [AnnonceController::class, 'rejeter'])->name('annonces.rejeter');

    // Avis
    Route::resource('avis', AvisController::class)->only(['index', 'show']);
    Route::patch('/avis/{avis}/toggle', [AvisController::class, 'toggle'])->name('avis.toggle');
    Route::get('/avis/masques', [AvisController::class, 'masques'])->name('avis.masques');

    // Utilisateurs
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggleBlock');

    // Statistiques
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
    Route::get('statistiques/annonces-mensuelles', [StatistiqueController::class, 'annoncesMensuelles']);
    Route::get('statistiques/{type}/details', [StatistiqueController::class, 'detailsParMois']);
    Route::get('statistiques/biens-mensuels', [StatistiqueController::class, 'biensMensuels']);
    Route::get('statistiques/utilisateurs-mensuels', [StatistiqueController::class, 'utilisateursMensuels']);
    Route::get('statistiques/avis-mensuels', [StatistiqueController::class, 'avisMensuels']);
    Route::get('statistiques/revenus-mensuels', [StatistiqueController::class, 'revenusMensuels']);

    // Signalements
    Route::get('/signalements', [SignalementController::class, 'index'])->name('signalements.index');
    Route::post('signalements/{signalement}/traiter', [SignalementController::class, 'traiter'])->name('signalements.traiter');
});

/*
|--------------------------------------------------------------------------
| PROFIL UTILISATEUR CONNECTÉ
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profil utilisateur
    Route::get('/mon-profil', [MonProfilController::class, 'index'])->name('monprofil.index');
    Route::put('/mon-profil', [MonProfilController::class, 'update'])->name('monprofil.update');

    // Dashboard global client
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');

    // Gestion portefeuille
    Route::prefix('portefeuille')->name('portefeuille.')->group(function () {
        Route::get('/', [PortefeuilleController::class, 'index'])->name('index');
        Route::post('/recharger', [PortefeuilleController::class, 'recharger'])->name('recharger');
        Route::post('/retirer', [PortefeuilleController::class, 'retirer'])->name('retirer');
    });

    /*
    |--------------------------------------------------------------------------
    | PARTIE LOCATAIRE : gérer demandes de location (faire & voir ses demandes)
    |--------------------------------------------------------------------------
    */
    Route::prefix('locataire')->name('locataire.')->group(function () {
        // Faire une demande de location pour une annonce donnée
        Route::get('demande/create/{annonce}', [LocataireDemandeController::class, 'create'])->name('demande.create');
        Route::post('demande/store/{annonce}', [LocataireDemandeController::class, 'store'])->name('demande.store');

        // Voir ses demandes envoyées
        Route::get('demandes/envoyees', [LocataireDemandeController::class, 'envoyees'])->name('demandes.envoyees');
    });


    /*
    |--------------------------------------------------------------------------
    | PARTIE PROPRIETAIRE : gérer annonces et demandes reçues
    |--------------------------------------------------------------------------
    */
    Route::prefix('proprietaire')->name('proprietaire.')->group(function () {
        // Gestion des annonces du propriétaire
        Route::get('mes-annonces', [ProprietaireAnnonceController::class, 'index'])->name('annonces.index');
        Route::get('mes-annonces/create', [ProprietaireAnnonceController::class, 'create'])->name('annonces.create');
        Route::post('mes-annonces', [ProprietaireAnnonceController::class, 'store'])->name('annonces.store');
        Route::get('mes-annonces/{annonce}', [ProprietaireAnnonceController::class, 'show'])->name('annonces.show');
        Route::get('mes-annonces/{annonce}/edit', [ProprietaireAnnonceController::class, 'edit'])->name('annonces.edit');
        Route::put('mes-annonces/{annonce}', [ProprietaireAnnonceController::class, 'update'])->name('annonces.update');
        Route::delete('mes-annonces/{annonce}', [ProprietaireAnnonceController::class, 'destroy'])->name('annonces.destroy');

        // Voir les demandes reçues pour ses annonces
        Route::get('demandes/recues', [ProprietaireDemandeController::class, 'recues'])->name('demandes.recues');

        // Optionnel : voir demandes envoyées (à garder si tu veux, sinon supprimer)
        Route::get('demandes/envoyees', [ProprietaireDemandeController::class, 'envoyees'])->name('demandes.envoyees');

        // Actions de validation/refus des demandes reçues
        Route::post('demandes/{id}/valider', [ProprietaireDemandeController::class, 'valider'])->name('demandes.valider');
        Route::post('demandes/{id}/refuser', [ProprietaireDemandeController::class, 'refuser'])->name('demandes.refuser');

        Route::get('avis', [ProprietaireAnnonceController::class, 'avisRecus'])->name('avis.recus');
    });

    /*
    |--------------------------------------------------------------------------
    | PARTIE CLIENT ANNONCE : publier une annonce rapide
    |--------------------------------------------------------------------------
    */
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/publier-annonce', [ClientAnnonceController::class, 'create'])->name('annonce.create');
        Route::post('/publier-annonce', [ClientAnnonceController::class, 'store'])->name('annonce.store');
    });

    Route::get('/annonces/{annonce}/avis/create', [AvisController::class, 'create'])->name('avis.create');
    Route::post('/annonces/{annonce}/avis', [AvisController::class, 'store'])->name('avis.store');
});

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION (Breeze ou Jetstream)
|--------------------------------------------------------------------------
*/



Route::get('/connexion', [CustomAuthController::class, 'showLoginRegister'])->name('auth.page');
Route::post('/connexion/login', [CustomAuthController::class, 'login'])->name('auth.login');
Route::post('/connexion/register', [CustomAuthController::class, 'register'])->name('auth.register');


require __DIR__ . '/auth.php';
