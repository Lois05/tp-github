@extends('layouts.admin')



@section('title', 'Dashboard Admin')

@section('content')
@php
    $totalAnnonces = 120;
    $annoncesAttente = 8;
    $totalUtilisateurs = 345;
    $totalCategories = 8;
    $litigesOuverts = 4;
    $revenuMensuel = 215000;
@endphp

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

    <!-- Section annonces + litiges -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-bordered">
                <div class="card-inner">
                    <h6>Annonces en attente</h6>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            Annonce #1023
                            <span>
                                <button class="btn btn-sm btn-success">Valider</button>
                                <button class="btn btn-sm btn-danger">Refuser</button>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            Annonce #1024
                            <span>
                                <button class="btn btn-sm btn-success">Valider</button>
                                <button class="btn btn-sm btn-danger">Refuser</button>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-bordered">
                <div class="card-inner">
                    <h6>Litiges récents</h6>
                    <ul>
                        <li>Litige #45678 - <span class="badge bg-warning">Ouvert</span></li>
                        <li>Litige #45679 - <span class="badge bg-success">Résolu</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Aucun modal pour l'instant -->
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
                data: [45, 30, 25],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b']
            }]
        }
    });
</script>
@endpush
