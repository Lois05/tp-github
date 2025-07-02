<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les annonces qui ont des avis, triées par le nombre d'avis (desc)
        $annonces = \App\Models\Annonce::withCount('avis') // ajoute un champ `avis_count`
            ->whereHas('avis') // uniquement celles qui ont au moins un avis
            ->with(['avis.user']) // charger les relations
            ->orderByDesc('avis_count') // trier par nombre d’avis décroissant
            ->get();

        return view('admin.avis.index', compact('annonces'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Avis $avis)
    {
        return view('admin.avis.show', compact('avis'));
    }

    public function masques()
    {
        $avisMasques = Avis::where('signale', true)
            ->where('statut', 'masqué') // si tu as un champ statut par exemple
            ->with(['user', 'annonce'])
            ->get();

        return view('admin.avis.masques', compact('avisMasques'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avis $avis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avis $avis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avis $avis)
    {
        //
    }

    public function toggle(Avis $avis)
    {
        // Bascule la valeur de "masque" ou crée la colonne si tu utilises "signale"
        $avis->masque = !$avis->masque;
        $avis->save();

        return redirect()->back()->with('success', 'Statut de l\'avis mis à jour.');
    }

}
