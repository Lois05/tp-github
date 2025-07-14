<?php

namespace App\Http\Controllers\Client\Locataire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeLocation;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    // Affichage du formulaire
    public function create($annonce_id)
    {
        return view('client.locataire.demande.create', compact('annonce_id'));
    }

    // Traitement du formulaire
    public function store(Request $request, $annonce)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        DemandeLocation::create([
            'annonce_id' => $annonce,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'message' => $request->message,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'user_id' => Auth::id(),

        ]);

        return redirect()->route('client.dashboard')->with('success', 'Demande envoyée avec succès. En attente de validation.');
    }
}
