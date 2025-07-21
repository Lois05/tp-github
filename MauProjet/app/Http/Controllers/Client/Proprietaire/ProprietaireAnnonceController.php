<?php

namespace App\Http\Controllers\Client\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProprietaireAnnonceController extends Controller
{
    /**
     * Liste toutes les annonces de l'utilisateur, même s'il n'est pas encore propriétaire.
     */
   public function index()
{
    $user = Auth::user();

    // Récupère toutes ses annonces via user_id
    $annonces = Annonce::where('user_id', $user->id)->latest()->get();

    return view('client.proprietaire.mes_annonces.index', compact('annonces'));
}

    /**
     * Affiche le formulaire pour créer une nouvelle annonce.
     */
    public function create()
    {
        return view('client.proprietaire.mes_annonces.create');
    }

    /**
     * Enregistre une nouvelle annonce.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        // Crée un profil propriétaire s'il n'existe pas encore
        $proprietaire = $user->proprietaire ?? Proprietaire::create([
            'user_id' => $user->id,
        ]);

        // Crée l'annonce
        $proprietaire->annonces()->create([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('client.proprietaire.mes_annonces.index')
            ->with('success', 'Annonce créée et en attente de validation.');
    }

    /**
     * Affiche une seule annonce de l'utilisateur.
     */
    public function show(Annonce $annonce)
    {
        $user = Auth::user();

        // Vérifie que l'annonce appartient à ce user
        if (!$user->proprietaire || $annonce->proprietaire_id !== $user->proprietaire->id) {
            abort(403, "Action non autorisée.");
        }

        return view('client.proprietaire.mes_annonces.show', compact('annonce'));
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Annonce $annonce)
    {
        $user = Auth::user();

        if (!$user->proprietaire || $annonce->proprietaire_id !== $user->proprietaire->id) {
            abort(403, 'Action non autorisée.');
        }

        return view('client.proprietaire.mes_annonces.edit', compact('annonce'));
    }

    /**
     * Met à jour l'annonce.
     */
    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        if (!$user->proprietaire || $annonce->proprietaire_id !== $user->proprietaire->id) {
            abort(403, 'Action non autorisée.');
        }

        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('client.proprietaire.mes_annonces.index')
            ->with('success', 'Annonce mise à jour.');
    }

    /**
     * Supprime l'annonce.
     */
    public function destroy(Annonce $annonce)
    {
        $user = Auth::user();

        if (!$user->proprietaire || $annonce->proprietaire_id !== $user->proprietaire->id) {
            abort(403, 'Action non autorisée.');
        }

        $annonce->delete();

        return redirect()->route('client.proprietaire.mes_annonces.index')
            ->with('success', 'Annonce supprimée.');
    }
}
