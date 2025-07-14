<?php

namespace App\Http\Controllers\Client\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeLocation;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;

class ProprietaireDemandeController extends Controller
{
    /**
     * Affiche toutes les demandes que l'utilisateur a envoyées
     */


   public function envoyees()
{
    $mesDemandes = DemandeLocation::where('locataire_id', Auth::id())->get();
    return view('client.proprietaire.demandes.envoyees', compact('mesDemandes'));
}

    /**
     * Affiche toutes les demandes reçues sur MES annonces
     */
    public function recues()
    {
        // Cherche toutes les annonces de ce proprio
        $mesAnnoncesIds = Annonce::where('user_id', Auth::id())->pluck('id');

        // Cherche toutes les demandes sur ces annonces
        $demandesRecues = DemandeLocation::whereIn('annonce_id', $mesAnnoncesIds)->get();

        return view('client.proprietaire.demandes.recues', compact('demandesRecues'));
    }
}
