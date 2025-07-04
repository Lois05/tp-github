<?php

namespace App\Http\Controllers\Client\Locataire;


use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function create($annonceId)
    {
        $annonce = Annonce::findOrFail($annonceId);
        return view('locataire.demande.create', compact('annonce'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        // Ici tu peux créer la demande en base si tu as un modèle Demande
        // Par exemple :
        // Demande::create([
        //     'annonce_id' => $request->annonce_id,
        //     'nom' => $request->nom,
        //     'email' => $request->email,
        //     'message' => $request->message,
        // ]);

        // Pour l’instant, juste une redirection avec succès
        return redirect()->route('client.home')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}
