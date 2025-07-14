<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\DemandeLocation;
use App\Models\Avis;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupère les annonces de l'utilisateur (en tant que propriétaire)
        $annonces = Annonce::where('user_id', $user->id)->latest()->get();

        // Récupère les demandes de location de l'utilisateur (en tant que locataire)
        $demandes = DemandeLocation::where('Locataire_id', $user->id)->latest()->get();

        // Récupère les avis reçus par l'utilisateur
        $avis = Avis::where('user_id', $user->id)->latest()->get();

        return view('client.dashboard', compact('user', 'annonces', 'demandes', 'avis'));
    }
}
