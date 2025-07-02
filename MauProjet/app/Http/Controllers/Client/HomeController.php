<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;  // Import du modèle Annonce

class HomeController extends Controller
{
   public function index()
{
    // Vue d'accueil, par ex 6 annonces récentes
    $annonces = Annonce::where('statut', 'validee')->latest()->take(6)->get();
    return view('client.index', compact('annonces'));
}

public function annonces()
{
    // Toutes les annonces paginées
    $annonces = Annonce::where('statut', 'validee')->latest()->paginate(12);
    return view('client.annonces', compact('annonces'));
}
}
