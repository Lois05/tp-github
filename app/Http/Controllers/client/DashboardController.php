<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\DemandeLocation;
use App\Models\Avis;
use App\Models\Portefeuille;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mes annonces (propriétaire) → toujours user_id direct
        $annonces = Annonce::where('user_id', $user->id)->get();

         // Mes demandes envoyées (locataire)
        $locataire = $user->locataire;
        $demandesEnvoyees = $locataire
            ? DemandeLocation::where('locataire_id', $locataire->id)->get()
            : collect();

        // Mes demandes reçues (propriétaire)
        $proprietaire = $user->proprietaire;
        $demandesRecues = $proprietaire
            ? DemandeLocation::where('proprietaire_id', $proprietaire->id)->get()
            : collect();

        // Avis reçus (exemple simple : sur le user)
        $avis = Avis::where('user_id', $user->id)->get();

        // ✅ Récupère le portefeuille lié à l'utilisateur
        $portefeuille = $user->portefeuille ?? null;
        $portefeuille = Portefeuille::where('locataire_id', $user->id)
            ->orWhere('proprietaire_id', $user->id)
            ->orWhere('admin_id', $user->id)
            ->first();

        return view('client.dashboard', [
            'user' => $user,
            'annonces' => $annonces,
            'demandes' => $demandesEnvoyees, // ✅ Renommé ici !
            'demandesRecues' => $demandesRecues,
            'avis' => $avis,
            'portefeuille' => $portefeuille,
        ]);
    }
}

