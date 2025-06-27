<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::all();
        return view('admin.annonce.index', compact('annonces'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'statut' => ['required', Rule::in(['validee', 'rejetee'])],
        ]);

        $annonce->update([
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.annonce.index')->with('success', 'Statut de l\'annonce mis à jour avec succès.');
    }


    public function show(Annonce $annonce)
    {
        return view('admin.annonce.show', compact('annonces'));
    }

    public function edit(Annonce $annonce)
    {
        $categories = Annonce::all();
        return view('admin.annonces.edit', compact('annonces'));
    }
}
