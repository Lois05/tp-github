<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnnonceController extends Controller
{
    /**
     * Affiche la liste des annonces avec pagination, filtre par statut et recherche.
     */
    public function index(Request $request)
    {
        $statut = $request->query('statut');
        $search = $request->query('search');

        $query = Annonce::query();

        // Gestion du filtre statut
        if ($statut && in_array($statut, ['en_attente', 'validee', 'rejetee'])) {
            // Assure-toi que les valeurs ici correspondent aux valeurs stockées en DB
            $mapping = [
                'en_attente' => 'en attente',
                'validee' => 'validee',
                'rejetee' => 'rejetee',
            ];
            $query->where('statut', $mapping[$statut]);
        }

        // Recherche texte sur titre et localisation
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('localisation', 'like', "%{$search}%");
            });
        }

        // Tri par date décroissante
        $annonces = $query->orderBy('created_at', 'desc')->paginate(10);

        // Conserve les paramètres dans la pagination
        $annonces->appends($request->only(['statut', 'search']));

        return view('admin.annonce.index', compact('annonces', 'statut', 'search'));
    }

    /**
     * Affiche une annonce spécifique.
     */
    public function show(Annonce $annonce)
    {
        return view('admin.annonce.show', compact('annonce'));
    }

    /**
     * Affiche le formulaire d'édition (validation/rejet).
     */
    public function edit(Annonce $annonce)
    {
        return view('admin.annonce.edit', compact('annonce'));
    }

    /**
     * Met à jour le statut de l'annonce.
     */
    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'statut' => ['required', Rule::in(['validee', 'rejetee'])],
        ]);

        $annonce->update([
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.annonces.index')->with('success', 'Statut de l\'annonce mis à jour avec succès.');
    }
}
