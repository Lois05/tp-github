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
    public function index(Request $request)
    {
        $filtre = $request->query('filtre');
        $search = $request->query('search');

        $annonces = \App\Models\Annonce::whereHas('avis', function ($query) use ($filtre, $search) {
            if ($filtre === 'masques') {
                $query->where('masque', true);
            } elseif ($filtre === 'affiches') {
                $query->where('masque', false);
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($u) use ($search) {
                        $u->where('nom', 'like', "%{$search}%");
                    })
                        ->orWhere('commentaire', 'like', "%{$search}%");
                });
            }
        })
            ->with([
                'avis' => function ($query) use ($filtre, $search) {
                    $query->with('user')
                        ->when($filtre === 'masques', fn($q) => $q->where('masque', true))
                        ->when($filtre === 'affiches', fn($q) => $q->where('masque', false))
                        ->when($search, function ($q) use ($search) {
                            $q->where(function ($inner) use ($search) {
                                $inner->whereHas('user', fn($u) => $u->where('nom', 'like', "%{$search}%"))
                                    ->orWhere('commentaire', 'like', "%{$search}%");
                            });
                        })
                        ->latest();
                }
            ])
            ->withCount('avis')
            ->latest()
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
