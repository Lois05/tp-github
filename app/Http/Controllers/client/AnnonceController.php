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
        ->paginate(9); // pagination pour utiliser links()

    $favorisIds = auth()->check()
        ? auth()->user()->favoris->pluck('annonce_id')->toArray()
        : [];

    return view('client.annonces.index', compact('annonces', 'favorisIds'));
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
        'image' => 'nullable|image|max:2048', // 👈 validation de l'image
    ]);

    $user = Auth::user();

    // Trouver ou créer le propriétaire
    $proprietaire = $user->proprietaire;
    if (!$proprietaire) {
        $proprietaire = new \App\Models\Proprietaire();
        $proprietaire->user_id = $user->id;
        $proprietaire->type = 'physique';
        $proprietaire->save();
    }

    // Créer le Bien
    $bien = Bien::create([
        'nom' => $request->titre,
        'description' => $request->description,
        'categorie_id' => $request->categorie_id,
        'proprietaire_id' => $proprietaire->id,
        'etat' => $request->etat ?? 'disponible',
    ]);

    // Par défaut aucune image
    $imagePath = null;

    // Si une image a été uploadée
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('annonces', 'public');
    }

    // Créer l'annonce avec l'image si présente
    Annonce::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'localisation' => $request->localisation,
        'prix' => $request->prix,
        'user_id' => $user->id,
        'bien_id' => $bien->id,
        'statut' => 'en_attente',
        'image' => $imagePath, // 👈 on enregistre le chemin ou null
    ]);

    return redirect()->route('client.annonces.index')
        ->with('success', 'Annonce publiée avec succès !');
}


  public function show($id)
{
    $annonce = Annonce::with(['bien.proprietaire.user'])->findOrFail($id);

    $avisLaissé = false;

    if (auth()->check()) {
        $avisLaissé = $annonce->avis()
            ->where('user_id', auth()->id())
            ->exists();
    }

    return view('client.annonces.show', [
        'annonce' => $annonce,
        'avisLaissé' => $avisLaissé,
    ]);
}

public function toggle($annonceId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }

        $exists = $user->favoris()->where('annonce_id', $annonceId)->exists();

        if ($exists) {
            $user->favoris()->detach($annonceId);
            $favoriAdded = false;
        } else {
            $user->favoris()->attach($annonceId);
            $favoriAdded = true;
        }

        $totalFavoris = $user->favoris()->count();

        return response()->json([
            'favoriAdded' => $favoriAdded,
            'totalFavoris' => $totalFavoris,
        ]);
    }
}
