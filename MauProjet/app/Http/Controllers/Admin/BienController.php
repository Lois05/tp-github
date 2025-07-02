<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Categorie;
use Illuminate\Http\Request;

class BienController extends Controller
{
    public function index(Request $request)
{
    $query = Bien::with('categorie');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nom', 'like', "%{$search}%")
              ->orWhereHas('categorie', function ($q) use ($search) {
                  $q->where('nom', 'like', "%{$search}%");
              });
    }

    if ($request->filled('etat')) {
        $query->where('etat', $request->etat);
    }

    $biens = $query->orderBy('created_at', 'asc')->paginate(10);

    return view('admin.biens.index', compact('biens'));
}


    public function create()
    {
        $categories = Categorie::all();
        return view('admin.biens.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
            'etat' => 'nullable|string|in:disponible,loué',
        ]);

        Bien::create($request->all());

        return redirect()->route('admin.biens.index')->with('success', 'Bien créé avec succès.');
    }

    public function show(Bien $bien)
    {
        return view('admin.biens.show', compact('bien'));
    }

    public function edit(Bien $bien)
    {
        $categories = Categorie::all();
        return view('admin.biens.edit', compact('bien', 'categories'));
    }

    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'nullable|exists:categories,id',
            'etat' => 'nullable|string|in:disponible,loué',
        ]);

        $bien->update($request->all());

        return redirect()->route('admin.biens.index')->with('success', 'Bien mis à jour avec succès.');
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return redirect()->route('admin.biens.index')->with('success', 'Bien supprimé avec succès.');
    }

    // Nouvelle méthode pour changer le statut
    public function toggleEtat(Bien $bien)
{
    $bien->etat = $bien->etat === 'loué' ? 'disponible' : 'loué';
    $bien->save();

    return redirect()->route('admin.biens.index')->with('success', 'Statut du bien mis à jour.');
}

}
