<?php

namespace App\Http\Controllers\Client\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Avis;
use App\Models\Proprietaire;
use App\Models\Categorie; // N'oublie pas d'importer Categorie si tu l'utilises
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProprietaireAnnonceController extends Controller
{
    public function index()
{
    $user = Auth::user();
  $annonces = Annonce::with('categorie')
    ->where('user_id', $user->id)
    ->latest()
    ->paginate(6); // Tu peux ajuster 6, 8, 9 selon ton design mobile

    return view('client.proprietaire.mes_annonces.index', compact('annonces'));
}


    public function create()
    {
        // On récupère les catégories pour la sélection dans le formulaire
        $categories = Categorie::all();
        return view('client.proprietaire.mes_annonces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        $proprietaire = $user->proprietaire ?? Proprietaire::create([
            'user_id' => $user->id,
        ]);

        $proprietaire->annonces()->create([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('proprietaire.annonces.index')
            ->with('success', 'Annonce créée et en attente de validation.');
    }

    public function show(Annonce $annonce)
    {
        $user = Auth::user();
        if ($annonce->user_id !== $user->id) {
            abort(403, "Action non autorisée.");
        }

          

        return view('client.proprietaire.mes_annonces.show', compact('annonce'));
    }

    public function edit(Annonce $annonce)
    {
        $user = Auth::user();

        if (
            (!$user->proprietaire && $annonce->user_id !== $user->id) ||
            ($user->proprietaire && $annonce->proprietaire_id !== $user->proprietaire->id && $annonce->user_id !== $user->id)
        ) {
            abort(403, 'Action non autorisée.');
        }

        $categories = Categorie::all();

        return view('client.proprietaire.mes_annonces.edit', compact('annonce', 'categories'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        if (
            (!$user->proprietaire && $annonce->user_id !== $user->id) ||
            ($user->proprietaire && $annonce->proprietaire_id !== $user->proprietaire->id && $annonce->user_id !== $user->id)
        ) {
            abort(403, 'Action non autorisée.');
        }

       $annonce->update([
    'titre' => $request->titre,
    'description' => $request->description,
]);

// ✅ On récupère le Bien lié et on met à jour SA catégorie :
$bien = $annonce->bien;
$bien->categorie_id = $request->categorie_id;
$bien->save();


        return redirect()->route('proprietaire.annonces.index')
            ->with('success', 'Annonce mise à jour.');
    }

    public function destroy(Annonce $annonce)
    {
        $user = Auth::user();

        if (
            (!$user->proprietaire && $annonce->user_id !== $user->id) ||
            ($user->proprietaire && $annonce->proprietaire_id !== $user->proprietaire->id && $annonce->user_id !== $user->id)
        ) {
            abort(403, 'Action non autorisée.');
        }

        $annonce->delete();

        return redirect()->route('proprietaire.annonces.index')
            ->with('success', 'Annonce supprimée.');
    }

    public function avisRecus()
    {
        $userId = Auth::id();

$avisRecus = Avis::whereHas('annonce', function($query) use ($userId) {
    $query->where('user_id', $userId); // user_id dans annonces = propriétaire
})->with('user', 'annonce')->latest()->get();


        return view('client.proprietaire.avis_recus', compact('avisRecus'));
    }
}
