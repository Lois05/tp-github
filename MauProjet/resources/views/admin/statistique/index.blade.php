@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="nk-block">
        <div class="nk-block-head">
            <h4 class="nk-block-title">Statistiques du système</h4>
            <p class="nk-block-des">Évolution de l'activité de la plateforme de location.</p>
        </div>


        <!-- Cartes Statistiques -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-4">
            @php
                $cards = [
                    [
                        'id' => 'annonces',
                        'icon' => 'ni-home',
                        'color' => 'primary',
                        'label' => 'Annonces',
                        'value' => $annonceCount,
                    ],
                    [
                        'id' => 'biens',
                        'icon' => 'ni-building',
                        'color' => 'success',
                        'label' => 'Biens',
                        'value' => $bienCount,
                    ],
                    [
                        'id' => 'utilisateurs',
                        'icon' => 'ni-users',
                        'color' => 'info',
                        'label' => 'Utilisateurs',
                        'value' => $userCount,
                    ],
                    [
                        'id' => 'avis',
                        'icon' => 'ni-folder-list',
                        'color' => 'warning',
                        'label' => 'Avis',
                        'value' => $avisCount,
                    ],
                    [
                        'id' => 'revenus',
                        'icon' => 'ni-coin-alt',
                        'color' => 'danger',
                        'label' => 'Revenus (mois)',
                        'value' => number_format($revenus, 0, ',', ' ') . ' FCFA',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{ $card['id'] }}"
                        class="text-decoration-none">
                        <div class="card card-bordered text-center bg-white h-100 shadow-sm">
                            <div class="card-inner py-4">
                                <em class="icon ni {{ $card['icon'] }} display-4 text-{{ $card['color'] }}"></em>
                                <h6 class="mt-3 text-dark">{{ $card['label'] }}</h6>
                                <h4 class="fw-bold mt-1 text-dark">{{ $card['value'] }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modales dynamiques -->
    @foreach ($cards as $card)
        <div class="modal fade" id="modal-{{ $card['id'] }}" tabindex="-1"
            aria-labelledby="modalLabel-{{ $card['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-{{ $card['id'] }}">Détail : {{ $card['label'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <canvas id="chart-{{ $card['id'] }}" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modale Annonces (graphique + filtre) -->
        <div class="modal fade" id="modal-annonces" tabindex="-1" aria-labelledby="modalLabel-annonces" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-annonces">Détail : Annonces</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <label for="filtre-annee-annonces" class="me-2">Année :</label>
                            <select id="filtre-annee-annonces" class="form-select w-auto">
                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <canvas id="chart-annonces" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modale Biens -->
        <div class="modal fade" id="modal-biens" tabindex="-1" aria-labelledby="modalLabel-biens" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-biens">Détail : Biens</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <label for="filtre-annee-biens" class="me-2">Année :</label>
                            <select id="filtre-annee-biens" class="form-select w-auto">
                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <canvas id="chart-biens" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartAnnonces = null;
        const mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

        function chargerGraphiqueAnnonces(annee) {
            fetch(`/admin/statistiques/annonces-mensuelles?year=${annee}`)
                .then(res => res.json())
                .then(data => {
                    if (chartAnnonces) {
                        chartAnnonces.data.datasets[0].data = data;
                        chartAnnonces.update();
                    } else {
                        chartAnnonces = new Chart(document.getElementById('chart-annonces'), {
                            type: 'bar',
                            data: {
                                labels: mois,
                                datasets: [{
                                    label: 'Annonces créées',
                                    data: data,
                                    backgroundColor: '#6366f1'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }
                });
        }

        // Lors de l'ouverture de la modale 'annonces'
        const modalAnnonces = document.getElementById('modal-annonces');
        modalAnnonces.addEventListener('shown.bs.modal', function() {
            const select = document.getElementById('filtre-annee-annonces');
            const selectedYear = select.value;
            if (!chartAnnonces) {
                chargerGraphiqueAnnonces(selectedYear);
            }
        });

        // Mise à jour du graphique si l'année change dans la modale
        document.getElementById('filtre-annee-annonces').addEventListener('change', function() {
            chargerGraphiqueAnnonces(this.value);
        });
    </script>

    <script>
        let chartBiens = null;
        const mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

        function chargerGraphiqueBiens(annee) {
            fetch(`/admin/statistiques/biens-mensuels?year=${annee}`)
                .then(res => res.json())
                .then(data => {
                    if (chartBiens) {
                        chartBiens.data.datasets[0].data = data;
                        chartBiens.update();
                    } else {
                        chartBiens = new Chart(document.getElementById('chart-biens'), {
                            type: 'bar',
                            data: {
                                labels: mois,
                                datasets: [{
                                    label: 'Biens créés',
                                    data: data,
                                    backgroundColor: '#6366f1'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }
                });
        }

        const modalBiens = document.getElementById('modal-biens');
        modalBiens.addEventListener('shown.bs.modal', function() {
            const select = document.getElementById('filtre-annee-biens');
            const selectedYear = select.value;
            if (!chartBiens) {
                chargerGraphiqueBiens(selectedYear);
            }
        });

        document.getElementById('filtre-annee-biens').addEventListener('change', function() {
            chargerGraphiqueBiens(this.value);
        });
    </script>
@endpush
