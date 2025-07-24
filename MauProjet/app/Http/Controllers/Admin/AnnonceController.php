<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $statut = $request->query('statut');
        $search = $request->query('search');

        $query = Annonce::with('user');


        if ($statut && in_array($statut, ['en_attente', 'validee', 'rejetee'])) {
            $mapping = [
                'en_attente' => 'en_attente',  // <-- Assure-toi que ça correspond à la base !
                'validee' => 'validee',
                'rejetee' => 'rejetee',
            ];
            $query->where('statut', $mapping[$statut]);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('localisation', 'like', "%{$search}%");
            });
        }

        // Trier par id asc pour avoir IDs en ordre croissant
        $annonces = $query->orderBy('id', 'desc')->paginate(10);
        $annonces->appends($request->only(['statut', 'search']));

        return view('admin.annonces.index', compact('annonces', 'statut', 'search'));
    }


    public function show(Annonce $annonce)
    {
        return view('admin.annonces.show', compact('annonce'));
    }

    public function edit(Annonce $annonce)
    {
        return view('admin.annonces.edit', compact('annonce'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'statut' => ['required', Rule::in(['validee', 'rejetee'])],
        ]);

        $annonce->update(['statut' => $request->statut]);

        return redirect()->route('admin.annonces.index')->with('success', 'Statut mis à jour.');
    }
}
