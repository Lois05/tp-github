<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class MonProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.monprofil.index', compact('user'));
    }

   public function update(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;

    $user->save(); // plus d'erreur

    return back()->with('success', 'Profil mis à jour avec succès.');
}

}
