<?php

namespace App\Http\Controllers;

use App\Models\Favori;  // <-- Import nécessaire ici
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function index()
    {
        $favoris = Favori::where('user_id', auth()->id())->get();
        return view('client.favoris.index', compact('favoris'));
    }
    
    public function store($annonceId)
{
    Favori::firstOrCreate([
        'user_id' => auth()->id(),
        'annonce_id' => $annonceId,
    ]);

    return back()->with('success', 'Annonce ajoutée aux favoris');
}

public function destroy($favoriId)
{
    $favori = Favori::findOrFail($favoriId);
    $favori->delete();

    return back()->with('success', 'Annonce retirée des favoris');
}

 public function toggle($annonceId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }

        $exists = $user->favoris()->where('annonce_id', $annonceId)->exists();

        if ($exists) {
            $user->favoris()->detach($annonceId);
            $favoriAdded = false;
        } else {
            $user->favoris()->attach($annonceId);
            $favoriAdded = true;
        }

        $totalFavoris = $user->favoris()->count();

        return response()->json([
            'favoriAdded' => $favoriAdded,
            'totalFavoris' => $totalFavoris,
        ]);
    }

}

