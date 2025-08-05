<?php

namespace App\Http\Controllers\Client\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    // Affiche les avis reçus sur les annonces du propriétaire connecté
    public function avisRecus()
{
    $user = Auth::user();

    $avisRecus = $user->proprietaire
        ->biens()
        ->with(['annonces.avis.user'])
        ->get()
        ->flatMap(fn ($bien) =>
            $bien->annonces->flatMap(fn ($annonce) =>
                $annonce->avis
            )
        );

    return view('client.proprietaire.avis_recus', compact('avisRecus'));
}

}
