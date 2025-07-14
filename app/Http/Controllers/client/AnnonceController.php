<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AnnonceController extends Controller
{
    public function create()
    {
        return view('client.annonces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'localisation' => 'required|string',
            'prix' => 'required|numeric',
            // ajoute les autres champs nécessaires ici
        ]);

        // Étape 1 : Créer un bien sans user_id
        $bien = Bien::create([
            'categorie_id' => 1, // valeur par défaut (tu peux la rendre dynamique plus tard)
            'nom' => 'Bien auto', // valeur générique
            'description' => 'Bien lié à une annonce automatiquement', // valeur générique
            // pas de user_id ici
        ]);



        // Étape 2 : Créer l'annonce avec le bien_id
        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'prix' => $request->prix,
            'statut' => 'en_attente',
            'user_id' => Auth::id(),

            'bien_id' => $bien->id,
        ]);

        return redirect()->route('client.annonces.index')->with('success', 'Annonce publiée avec succès !');
    }
}

