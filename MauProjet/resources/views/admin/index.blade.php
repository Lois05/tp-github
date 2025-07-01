@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="nk-block">
    <div class="nk-block-head">
        <h4 class="nk-block-title">Tableau de bord administrateur</h4>
        <p class="nk-block-des">Aperçu global de l'activité de la plateforme de location.</p>
    </div>

    <!-- Cartes Statistiques -->
    <div class="row g-4">
        @php
            $cards = [
                ['icon' => 'ni-home', 'color' => 'primary', 'label' => 'Annonces', 'value' => $totalAnnonces, 'subtitle' => "$annoncesAttente en attente"],
                ['icon' => 'ni-users', 'color' => 'info', 'label' => 'Utilisateurs', 'value' => $totalUtilisateurs, 'subtitle' => ''],
                ['icon' => 'ni-folder-list', 'color' => 'success', 'label' => 'Catégories', 'value' => $totalCategories, 'subtitle' => ''],
                ['icon' => 'ni-coin-alt', 'color' => 'warning', 'label' => 'Revenus (mois)', 'value' => number_format($revenuMensuel, 0, ',', ' ') . ' FCFA', 'subtitle' => '']
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-6 col-lg-3">
            <div class="card card-bordered text-center bg-white h-100 shadow-sm">
                <div class="card-inner py-4">
                    <em class="icon ni {{ $card['icon'] }} display-4 text-{{ $card['color'] }}"></em>
                    <h6 class="mt-3">{{ $card['label'] }}</h6>
                    <h4 class="fw-bold mt-1">{{ $card['value'] }}</h4>
                    @if($card['subtitle'])
                    <small class="text-muted">{{ $card['subtitle'] }}</small>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Graphiques -->
    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="card card-bordered shadow-sm">
                <div class="card-inner">
                    <h6 class="mb-3">Évolution des locations</h6>
                    <canvas id="chartLocations" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-bordered shadow-sm">
                <div class="card-inner">
                    <h6 class="mb-3">Répartition des biens</h6>
                    <canvas id="chartBiens" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartLocations'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
            datasets: [{
                label: 'Locations',
                data: [5, 10, 7, 14, 20],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('chartBiens'), {
        type: 'pie',
        data: {
            labels: ['Électroménagers', 'Véhicules', 'Divers'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush
