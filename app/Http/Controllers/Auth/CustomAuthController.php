<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        'username' => 'required|string|max:255|unique:users',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:20',
        'email' => 'required|email|unique:users',
        'telephone' => 'required|string|max:20',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::create([
        'username' => $request->username,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Inscription réussie.');
}



}
