<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Afficher 6 annonces validées récentes sur la page d'accueil
        $annonces = Annonce::where('statut', 'validee')->latest()->take(6)->get();
        return view('client.index', compact('annonces'));
    }

    public function annonces()
    {
        // Afficher toutes les annonces paginées (12 par page)
        $annonces = Annonce::where('statut', 'validee')->latest()->paginate(12);
        return view('client.annonces.index', compact('annonces'));
    }

 public function showAnnonce($id)
{
    $annonce = Annonce::with(['bien.categorie', 'user'])->findOrFail($id);

    return view('client.annonces.show', compact('annonce'));
}

    public function contact()
    {
        return view('client.contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Ici tu peux traiter les données : enregistrer en base, envoyer mail, etc.

        // Exemple simple : rediriger avec message de succès
        return redirect()->route('client.contact')->with('success', 'Merci pour votre message, nous vous répondrons rapidement.');
    }

    public function about()
    {
        return view('client.about');
    }
}
