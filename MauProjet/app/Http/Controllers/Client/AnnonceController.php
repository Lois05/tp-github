<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\Categorie;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with(['bien.categorie', 'bien.proprietaire.user'])
            ->where('statut', 'validee')
            ->latest()
            ->get();

        return view('client.accueil', compact('annonces'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('client.annonces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'localisation' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'etat' => 'nullable|string|in:disponible,loué,en maintenance,indisponible',
        ]);

        $user = Auth::user();

        // 🔑 Toujours trouver ou créer un propriétaire pour l'utilisateur connecté
        $proprietaire = $user->proprietaire;

        if (!$proprietaire) {
            $proprietaire = new \App\Models\Proprietaire();
            $proprietaire->user_id = $user->id;
            $proprietaire->type = 'physique';
            $proprietaire->save();
        }

        $dataBien = [
            'nom' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'proprietaire_id' => $proprietaire->id,
            'etat' => $request->etat ?? 'disponible',
        ];

       
        // Ensuite on peut créer le Bien avec un proprietaire_id garanti :
        $bien = Bien::create([
            'nom' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'proprietaire_id' => $proprietaire->id, // Toujours présent
            'etat' => $request->etat ?? 'disponible',
        ]);

        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'prix' => $request->prix,
            'user_id' => $user->id,
            'bien_id' => $bien->id,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('client.annonces.index')
            ->with('success', 'Annonce publiée avec succès !');
    }

    public function show($id)
    {
        $annonce = Annonce::with(['bien.categorie', 'bien.proprietaire.user'])->findOrFail($id);

        return view('client.annonces.show', compact('annonce'));
    }
}
