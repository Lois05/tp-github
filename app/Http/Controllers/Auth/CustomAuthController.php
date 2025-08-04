<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Locataire;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function showLoginRegister()
    {
        return view('auth.custom-auth');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Connexion réussie.');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe invalide.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'type_personne' => 'required|in:physique,morale',

            // validations conditionnelles
            'date_naissance' => 'required_if:type_personne,physique|nullable|date',
            'npi' => 'required_if:type_personne,physique|nullable|string',
            'raison_sociale' => 'required_if:type_personne,morale|nullable|string',
            'registre_commerce' => 'required_if:type_personne,morale|nullable|string',
            'representant_legal' => 'required_if:type_personne,morale|nullable|string',
        ]);

        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'username' => $request->username,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->type_personne === 'physique') {
            Locataire::create([
                'user_id' => $user->id,
                'type' => 'physique',
                'date_naissance' => $request->date_naissance,
                'npi' => $request->npi,
            ]);
        } else {
            Locataire::create([
                'user_id' => $user->id,
                'type' => 'morale',
                'raison_sociale' => $request->raison_sociale,
                'registre_commerce' => $request->registre_commerce,
                'representant_legal' => $request->representant_legal,
            ]);
        }

        Auth::login($user);

        return redirect()->route('client.dashboard')->with('success', 'Bienvenue sur LocaPlus !');
    }
}
