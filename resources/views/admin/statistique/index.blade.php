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
                        'chart' => true,
                        'endpoint' => '/admin/statistiques/annonces-mensuelles',
                        'chartLabel' => 'Annonces créées',
                        'colorCode' => '#6366f1',
                    ],
                    [
                        'id' => 'biens',
                        'icon' => 'ni-building',
                        'color' => 'success',
                        'label' => 'Biens',
                        'value' => $bienCount,
                        'chart' => true,
                        'endpoint' => '/admin/statistiques/biens-mensuels',
                        'chartLabel' => 'Biens créés',
                        'colorCode' => '#6366f1',
                    ],
                    [
                        'id' => 'utilisateurs',
                        'icon' => 'ni-users',
                        'color' => 'info',
                        'label' => 'Utilisateurs',
                        'value' => $userCount,
                        'chart' => true,
                        'endpoint' => '/admin/statistiques/utilisateurs-mensuels',
                        'chartLabel' => 'Utilisateurs inscrits',
                        'colorCode' => '#0ea5e9',
                    ],
                    [
                        'id' => 'avis',
                        'icon' => 'ni-folder-list',
                        'color' => 'warning',
                        'label' => 'Avis',
                        'value' => $avisCount,
                        'chart' => true, // ← activer la modale graphique
                        'endpoint' => '/admin/statistiques/avis-mensuels',
                        'chartLabel' => 'Avis soumis',
                        'colorCode' => '#f59e0b', // orange
                    ],

                    [
                        'id' => 'revenus',
                        'icon' => 'ni-coin-alt',
                        'color' => 'danger',
                        'label' => 'Revenus (mois)',
                        'value' => $revenus, ' FCFA',
                        'chart' => true,
                        'endpoint' => '/admin/statistiques/revenus-mensuels',
                        'chartLabel' => 'Revenus perçus (FCFA)',
                        'colorCode' => '#ef4444', // rouge
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col">
                    @if ($card['chart'])
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{ $card['id'] }}"
                            class="text-decoration-none">
                    @endif
                    <div class="card card-bordered text-center bg-white h-100 shadow-sm">
                        <div class="card-inner py-4">
                            <em class="icon ni {{ $card['icon'] }} display-4 text-{{ $card['color'] }}"></em>
                            <h6 class="mt-3 text-dark">{{ $card['label'] }}</h6>
                            <h4 class="fw-bold mt-1 text-dark">{{ $card['value'] }}</h4>
                        </div>
                    </div>
                    @if ($card['chart'])
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modales dynamiques avec graphiques -->
    @foreach ($cards as $card)
        @if ($card['chart'])
            <div class="modal fade" id="modal-{{ $card['id'] }}" tabindex="-1"
                aria-labelledby="modalLabel-{{ $card['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $card['id'] }}">Détail : {{ $card['label'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <label for="filtre-annee-{{ $card['id'] }}" class="me-2">Année :</label>
                                <select id="filtre-annee-{{ $card['id'] }}" class="form-select w-auto">
                                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <canvas id="chart-{{ $card['id'] }}" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

        function initChart(modalId, selectId, canvasId, endpoint, label, color) {
            let chart = null;
            const modal = document.getElementById(modalId);
            const select = document.getElementById(selectId);

            function loadData(year) {
                fetch(`${endpoint}?year=${year}`)
                    .then(res => res.json())
                    .then(data => {
                        if (chart) {
                            chart.data.datasets[0].data = data;
                            chart.update();
                        } else {
                            chart = new Chart(document.getElementById(canvasId), {
                                type: 'bar',
                                data: {
                                    labels: mois,
                                    datasets: [{
                                        label: label,
                                        data: data,
                                        backgroundColor: color
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

            modal.addEventListener('shown.bs.modal', function() {
                loadData(select.value);
            });

            select.addEventListener('change', function() {
                loadData(this.value);
            });
        }

        // Initialisation des graphiques dynamiques
        @foreach ($cards as $card)
            @if ($card['chart'])
                initChart(
                    'modal-{{ $card['id'] }}',
                    'filtre-annee-{{ $card['id'] }}',
                    'chart-{{ $card['id'] }}',
                    '{{ $card['endpoint'] }}',
                    '{{ $card['chartLabel'] }}',
                    '{{ $card['colorCode'] }}'
                );
            @endif
        @endforeach
    </script>
@endpush
