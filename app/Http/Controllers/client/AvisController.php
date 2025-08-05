<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function create($annonceId)
    {
        $annonce = Annonce::findOrFail($annonceId);
        return view('client.avis.create', compact('annonce'));
    }

    public function store(Request $request, $annonceId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:1000',
        ]);

        $annonce = Annonce::findOrFail($annonceId);

        Avis::create([
            'user_id' => Auth::id(),
            'annonce_id' => $annonce->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('client.annonces.show', $annonce->id)
            ->with('success', 'Votre avis a bien été enregistré.');
    }
}
