<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Categorie;
use Illuminate\Http\Request;

class BienController extends Controller
{
    public function index()
    {
        $biens = Bien::all();
        return view('admin.bien.index', compact('biens'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('admin.bien.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        Bien::create($request->all());

        return redirect()->route('admin.biens.index')->with('success', 'Bien créé avec succès.');
    }

    public function show(Bien $bien)
    {
        return view('admin.bien.show', compact('bien'));
    }

    public function edit(Bien $bien)
    {
        $categories = Categorie::all();
        return view('admin.bien.edit', compact('bien', 'categories'));
    }

    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $bien->update($request->all());

        return redirect()->route('admin.biens.index')->with('success', 'Bien mis à jour avec succès.');
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return redirect()->route('admin.biens.index')->with('success', 'Bien supprimé avec succès.');
    }
}
