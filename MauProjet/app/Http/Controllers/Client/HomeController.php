<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;  // Import du modèle Annonce

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 6 dernières annonces (ajuste selon ta logique)
        $annonces = Annonce::latest()->take(6)->get();

        // Passer les annonces à la vue
        return view('client.index', compact('annonces'));
    }
}
