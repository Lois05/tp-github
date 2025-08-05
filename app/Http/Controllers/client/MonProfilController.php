<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MonProfilController extends Controller
{
    // Affiche la page du profil avec les infos utilisateur
    public function index()
    {
        $user = Auth::user();
        return view('client.monprofil.index', compact('user'));
    }

    // Formulaire d'édition (optionnel si tu l'as)
    public function edit()
    {
        $user = Auth::user();
        return view('client.monprofil.edit', compact('user'));
    }

    // Met à jour les infos du profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('monprofil.index')->with('success', 'Profil mis à jour avec succès.');
    }

    // Affiche le formulaire de changement de mot de passe
    public function changePasswordForm()
    {
        return view('client.monprofil.change-password');
    }

    // Traite le changement de mot de passe
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Laravel 8+ vérifie le mot de passe actuel
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('monprofil.index')->with('success', 'Mot de passe changé avec succès.');
    }
}

