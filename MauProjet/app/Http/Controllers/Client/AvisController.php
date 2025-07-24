<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Affiche la liste des avis reçus pour les annonces du propriétaire connecté.
     */
    public function avisRecus()
    {
        $user = Auth::user();

        if (!$user->proprietaire) {
            abort(403, 'Vous n’êtes pas propriétaire.');
        }

        $avisRecus = Avis::whereHas('annonce', function ($q) use ($user) {
            $q->where('proprietaire_id', $user->proprietaire->id);
        })->with('annonce', 'user')->latest()->get();

        return view('client.proprietaire.avis_recus', compact('avisRecus'));
    }

    /**
     * Affiche le formulaire pour laisser un avis sur une annonce donnée.
     */
    public function create(Annonce $annonce)
    {
        // Ici tu peux vérifier si l'utilisateur a bien loué cet annonce avant de laisser un avis

        return view('client.avis.create', compact('annonce'));
    }

    /**
     * Enregistre un nouvel avis.
     */
    public function store(Request $request, Annonce $annonce)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Vérifie que l'utilisateur n'a pas déjà laissé un avis sur cette annonce (optionnel)
        $existing = Avis::where('annonce_id', $annonce->id)
                        ->where('user_id', $user->id)
                        ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['Vous avez déjà laissé un avis sur cette annonce.']);
        }

        Avis::create([
            'annonce_id' => $annonce->id,
            'user_id' => $user->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('client.annonces.show', $annonce->id)
            ->with('success', 'Merci pour votre avis !');
    }
}
