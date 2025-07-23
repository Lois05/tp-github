<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function index()
    {
        $signalements = Signalement::with(['annonce', 'user'])->latest()->get();
        return view('admin.signalement.index', compact('signalements'));
    }


    public function traiter(Request $request, Signalement $signalement)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'masquer':
                $signalement->annonce->update(['statut' => 'masquee']);
                $signalement->update(['statut' => 'traitee']);
                break;
            case 'supprimer':
                $signalement->annonce->delete();
                $signalement->update(['statut' => 'traitee']);
                break;
            case 'clore':
                $signalement->update(['statut' => 'traitee']);
                break;
        }

        return redirect()->back()->with('success', 'Signalement traité.');
    }
}
