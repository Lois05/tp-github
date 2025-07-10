<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\User;
use App\Models\Avis;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $year = $request->get('year', now()->year);

        $biensParMois = Bien::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('mois')
            ->pluck('total', 'mois');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $biensParMois[$i] ?? 0;
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
}
