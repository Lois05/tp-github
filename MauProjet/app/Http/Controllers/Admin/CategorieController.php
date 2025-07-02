<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
{
    $categories = Categorie::paginate(10); // paginate 10 par page

    return view('admin.categorie_bien.index', compact('categories'));
}


    public function create()
    {
        return view('admin.categorie_bien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('admin.categorie-bien.index')->with('success', 'Catégorie créée avec succès.');
    }

    public function show(Categorie $categorie)
    {
        return view('admin.categorie_bien.show', compact('categorie'));
    }

    public function edit(Categorie $categorie)
    {
        return view('admin.categorie_bien.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categorie->update($request->all());

        return redirect()->route('admin.categorie-bien.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('admin.categorie-bien.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
