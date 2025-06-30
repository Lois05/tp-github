<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\User;
use App\Models\Categorie;

class HomeController extends Controller
{
    public function index()
    {
        $totalAnnonces = Annonce::count();
        $annoncesAttente = Annonce::where('statut', 'en_attente')->count();
        $totalUtilisateurs = User::count();
        $totalCategories = Categorie::count();
        $revenuMensuel = Annonce::where('statut', 'validee')->sum('prix');

        return view('admin.index', compact(
            'totalAnnonces',
            'annoncesAttente',
            'totalUtilisateurs',
            'totalCategories',
            'revenuMensuel'
        ));
    }
}
