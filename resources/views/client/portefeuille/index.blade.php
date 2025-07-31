@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">💼 Mon Portefeuille</h1>

    {{-- Alertes --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     {{-- Carte Solde --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-body">
            <h4 class="fw-bold mb-2">Solde disponible</h4>
            <p class="fs-2 text-success fw-bold mb-1">
                {{ number_format($portefeuille->solde ?? 48750, 0, ',', ' ') }} FCFA
            </p>
            <span class="text-muted">Mis à jour le {{ now()->format('d/m/Y à H:i') }}</span>
        </div>
    </div>
    <div class="row g-4">
        {{-- Formulaire de recharge --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">🔄 Recharger mon portefeuille</h5>
                    <form method="POST" action="{{ route('portefeuille.recharger') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant (FCFA)</label>
                            <input type="number" name="montant" id="montant" class="form-control" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Recharger</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Formulaire de retrait (simulation) --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">💸 Retirer de l'argent</h5>
                    <form method="POST" action="#">
                        {{-- Simulation : pas encore relié --}}
                        @csrf
                        <div class="mb-3">
                            <label for="retrait" class="form-label">Montant à retirer (FCFA)</label>
                            <input type="number" name="retrait" id="retrait" class="form-control" min="1" max="{{ $portefeuille->solde ?? 0 }}" required>
                        </div>
                        <button type="button" class="btn btn-danger w-100" disabled>Retirer</button>
                        <small class="text-muted d-block mt-2">🚧 Retirez des frais</small>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Historique des transactions (simulation) --}}
    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h5 class="fw-bold mb-3">📜 Historique des transactions</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Exemple statique --}}
                    <tr>
                        <td>2025-07-15</td>
                        <td class="text-success">Rechargement</td>
                        <td>+ 10 000 FCFA</td>
                        <td><span class="badge bg-success">Validé</span></td>
                    </tr>
                    <tr>
                        <td>2025-07-12</td>
                        <td class="text-danger">Retrait</td>
                        <td>- 5 000 FCFA</td>
                        <td><span class="badge bg-secondary">En attente</span></td>
                    </tr>
                    <tr>
                        <td>2025-07-10</td>
                        <td class="text-success">Rechargement</td>
                        <td>+ 20 000 FCFA</td>
                        <td><span class="badge bg-success">Validé</span></td>
                    </tr>
                </tbody>
            </table>
            <small class="text-muted">* Historique simulé — Ajoutez une table `transactions` pour le rendre dynamique.</small>
        </div>
    </div>
</div>
@endsection
