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
        $annonces = Annonce::with(['avis.user'])->get(); // charge les avis de chaque annonce
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
        $avis = Avis::where('masque', true)->with(['annonce', 'user'])->latest()->get();
        return view('admin.avis.masque', compact('avis'));
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

    public function toggleMasque(Avis $avis)
    {
        $avis->masque = !$avis->masque;
        $avis->save();

        return back()->with('success', 'Statut de visibilité mis à jour.');
    }
}
