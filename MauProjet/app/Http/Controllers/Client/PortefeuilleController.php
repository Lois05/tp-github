<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portefeuille;
use Illuminate\Support\Facades\Auth;

class PortefeuilleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $portefeuille = Portefeuille::where('locataire_id', $user->id)
            ->orWhere('proprietaire_id', $user->id)
            ->orWhere('admin_id', $user->id)
            ->first();

        return view('client.portefeuille.index', compact('portefeuille'));
    }

    public function recharger(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:1',
        ]);


        $user = Auth::user();
        $portefeuille = Portefeuille::where('locataire_id', $user->id)
            ->orWhere('proprietaire_id', $user->id)
            ->orWhere('admin_id', $user->id)
            ->first();

        if (!$portefeuille) {
            return back()->withErrors(['portefeuille' => 'Portefeuille introuvable.']);
        }

        $portefeuille->solde += $request->montant;
        $portefeuille->save();

        return back()->with('success', 'Rechargement effectué avec succès !');
    }
}
