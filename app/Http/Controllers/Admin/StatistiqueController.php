<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\User;
use App\Models\Avis;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;

        return view('admin.statistique.index', [
            'annonceCount' => Annonce::count(),
            'bienCount' => Bien::count(),
            'userCount' => User::count(),
            'avisCount' => Avis::count(),
            'revenus' => Paiement::whereYear('created_at', $currentYear)->sum('montant'),
        ]);
    }

    public function annoncesMensuelles(Request $request)
    {
        $year = $request->input('year', now()->year);

        $result = Annonce::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('mois')
            ->pluck('total', 'mois');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $result[$i] ?? 0;
        }

        return response()->json($data);
    }

    public function biensMensuels(Request $request)
    {
        $year = $request->input('year', now()->year);

        $result = Bien::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('mois')
            ->pluck('total', 'mois');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $result[$i] ?? 0;
        }

        return response()->json($data);
    }

    public function detailsParMois(Request $request, $type)
    {
        $year = $request->input('year', now()->year);
        $modelMap = [
            'annonces' => Annonce::class,
            'biens' => Bien::class,
            'utilisateurs' => User::class,
            'avis' => Avis::class,
            'revenus' => Paiement::class,
        ];

        if (!isset($modelMap[$type])) {
            return response()->json([], 400);
        }

        $model = $modelMap[$type];

        if ($type === 'revenus') {
            $result = $model::select(DB::raw('MONTH(created_at) as mois'), DB::raw('SUM(montant) as total'))
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('mois')
                ->pluck('total', 'mois');
        } else {
            $result = $model::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('mois')
                ->pluck('total', 'mois');
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $result[$i] ?? 0;
        }

        return response()->json($data);
    }

    public function utilisateursMensuels(Request $request)
    {
        $year = $request->get('year', now()->year);

        $result = User::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('mois')
            ->pluck('total', 'mois');
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $result[$i] ?? 0;
        }

        return response()->json($data);
    }

    public function avisMensuels(Request $request)
    {
        $year = $request->get('year', now()->year);

        // On récupère le nombre d'avis par mois pour l'année donnée
        $data = DB::table('avis')
            ->selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'mois');

        // Préparer les données pour les 12 mois (remplis à 0 si aucun avis ce mois-là)
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data->get($i, 0);
        }

        return response()->json($result);
    }

    public function revenusMensuels(Request $request)
    {
        $year = $request->get('year', now()->year);

        // Requête pour obtenir la somme des paiements confirmés par mois
        $data = DB::table('paiements')
            ->selectRaw('MONTH(date_paiement) as mois, SUM(montant) as total')
            ->whereYear('date_paiement', $year)
            ->where('statut', 'validé') // si applicable
            ->groupByRaw('MONTH(date_paiement)')
            ->pluck('total', 'mois');

        // Générer tableau de 12 mois (rempli à 0 si aucun revenu)
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = (float) $data->get($i, 0);
        }

        return response()->json($result);
    }
}
