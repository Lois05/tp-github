<?php

namespace App\Http\Controllers\Client\Locataire;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\DemandeLocation;
use App\Models\Proprietaire;
use App\Models\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    // Affichage du formulaire
    public function create(Annonce $annonce)
    {
        return view('client.locataire.demandes.create', [
            'annonce' => $annonce
        ]);
    }

    // Traitement du formulaire
    public function store(Request $request, $annonceId)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $annonce = Annonce::with('bien')->findOrFail($annonceId);
        $user = Auth::user();

        $locataire = $user->locataire ?? Locataire::create(['user_id' => $user->id]);
        $proprietaire = Proprietaire::where('user_id', $annonce->user_id)->firstOrFail();



        DemandeLocation::create([
            'nom' => $request->nom,
            'annonce_id' => $annonce->id,
            'bien_id' => $annonce->bien->id,
            'locataire_id' => $locataire->id,
            'proprietaire_id' => $proprietaire->id,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'message' => $request->message,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en_attente',
        ]);

       return redirect()->route('client.dashboard')->with('success', 'Demande envoyée et en attente de validation !');

    }


    // ✅ MANQUANT : Afficher MES DEMANDES envoyées
public function envoyees()
{
    $locataire = Auth::user()->locataire;

    if (!$locataire) {
        $demandes = collect();
    } else {
        $demandes = DemandeLocation::where('locataire_id', $locataire->id)->latest()->get();
    }

    return view('client.locataire.demandes.envoyees', [
        'demandes' => $demandes,
        'count' => $demandes->count(),
    ]);
}



}
