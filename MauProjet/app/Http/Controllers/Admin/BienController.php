<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biens = Bien::all();
        return view('admin.bien.index', compact('biens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.bien.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        Bien::create($request->all());

        return redirect()->route('admin.bien.index')->with('success', 'Bien créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Bien $bien)
    {
        return view('admin.bien.show', compact('bien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bien $bien)
    {
        $categories = Categorie::all();
        return view('admin.bien.edit', compact('bien', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $bien->update($request->all());

        return redirect()->route('admin.bien.index')->with('success', 'Bien mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bien $bien)
    {
        $bien->delete();
        return redirect()->route('admin.bien.index')->with('success', 'Bien supprimé avec succès.');
    }
}
