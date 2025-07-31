<?php

namespace App\Http\Controllers\Client\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeLocation;
use App\Models\Annonce;
use App\Models\Proprietaire;
use Illuminate\Support\Facades\Auth;

class ProprietaireDemandeController extends Controller
{
    public function envoyees()
{
    $proprietaire = Auth::user()->proprietaire;

    if (!$proprietaire) {
        $demandes = collect();
        return view('client.proprietaire.demandes.envoyees', compact('demandes'));
    }

    $demandes = DemandeLocation::where('proprietaire_id', $proprietaire->id)
        ->latest()
        ->get();

    return view('client.proprietaire.demandes.envoyees', compact('demandes'));
}


    /**
     * Affiche toutes les demandes reçues en tant que PROPRIÉTAIRE
     */
    public function recues()
    {
        // Récupérer le profil propriétaire lié à l'utilisateur
        $proprietaire = Auth::user()->proprietaire;

        // Si pas de profil propriétaire, tenter de créer s'il a une annonce
        if (!$proprietaire) {
            $annonce = Annonce::where('user_id', Auth::id())->first();

            if ($annonce) {
                // Créer le profil propriétaire automatiquement
                $proprietaire = Proprietaire::create([
                    'user_id' => Auth::id(),
                ]);
            } else {
                // Pas de profil et pas d'annonce, retourner collection vide
                $demandes = collect();
                return view('client.proprietaire.demandes.recues', compact('demandes'));
            }
        }

        $demandes = DemandeLocation::where('proprietaire_id', $proprietaire->id)
            ->latest()
            ->get();

        return view('client.proprietaire.demandes.recues', compact('demandes'));
    }

    /**
     * Accepter une demande
     */
    public function valider($id)
    {
        $demande = DemandeLocation::findOrFail($id);

        $proprietaire = Auth::user()->proprietaire;

        if (!$proprietaire || $demande->proprietaire_id !== $proprietaire->id) {
            abort(403, "Action non autorisée.");
        }

        $demande->statut = 'acceptée';
        $demande->save();

        return back()->with('success', 'Demande acceptée.');
    }

    /**
     * Refuser une demande
     */
    public function refuser($id)
    {
        $demande = DemandeLocation::findOrFail($id);

        $proprietaire = Auth::user()->proprietaire;

        if (!$proprietaire || $demande->proprietaire_id !== $proprietaire->id) {
            abort(403, "Action non autorisée.");
        }

        $demande->statut = 'refusée';
        $demande->save();

        return back()->with('success', 'Demande refusée.');
    }
}
