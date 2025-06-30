@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="nk-block">
    <div class="nk-block-head">
        <h4 class="nk-block-title">Tableau de bord administrateur</h4>
        <p class="nk-block-des">Aperçu global de l'activité de la plateforme de location.</p>
    </div>

    <!-- Cartes Statistiques -->
    <div class="row g-gs">
        <div class="col-md-3">
            <div class="card card-bordered text-center bg-white">
                <div class="card-inner">
                    <em class="icon ni ni-home display-4 text-primary"></em>
                    <h6>Annonces</h6>
                    <h4>{{ $totalAnnonces }}</h4>
                    <small>{{ $annoncesAttente }} en attente</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-bordered text-center bg-white">
                <div class="card-inner">
                    <em class="icon ni ni-users display-4 text-info"></em>
                    <h6>Utilisateurs</h6>
                    <h4>{{ $totalUtilisateurs }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-bordered text-center bg-white">
                <div class="card-inner">
                    <em class="icon ni ni-folder-list display-4 text-success"></em>
                    <h6>Catégories</h6>
                    <h4>{{ $totalCategories }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-bordered text-center bg-white">
                <div class="card-inner">
                    <em class="icon ni ni-coin-alt display-4 text-warning"></em>
                    <h6>Revenus (mois)</h6>
                    <h4>{{ number_format($revenuMensuel, 0, ',', ' ') }} FCFA</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-bordered">
                <div class="card-inner">
                    <h6>Évolution des locations</h6>
                    <canvas id="chartLocations"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-bordered">
                <div class="card-inner">
                    <h6>Répartition des biens</h6>
                    <canvas id="chartBiens"></canvas>
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
                data: [5, 10, 7, 14, 20], // Tu pourras rendre cela dynamique plus tard avec JSON
                borderColor: 'blue',
                fill: false
            }]
        }
    });

    new Chart(document.getElementById('chartBiens'), {
        type: 'pie',
        data: {
            labels: ['Appartements', 'Maisons', 'Véhicules'],
            datasets: [{
                data: [45, 30, 25], // À remplacer par des données réelles si besoin
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b']
            }]
        }
    });
</script>
@endpush
