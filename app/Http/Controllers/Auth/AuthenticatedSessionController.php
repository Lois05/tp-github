<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de connexion personnalisée.
     */
    public function create(): View
    {
        return view('auth.custom-auth'); // Remplace par ta vue unifiée Connexion / Inscription
    }

    /**
     * Gère la tentative de connexion.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Tente de se connecter

        $request->session()->regenerate(); // Sécurité : régénérer la session

        return redirect()->intended(route('dashboard')); // Redirige vers la page voulue, ou dashboard par défaut
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirection après déconnexion
    }
}
