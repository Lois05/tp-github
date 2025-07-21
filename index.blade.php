@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Mon portefeuille</h2>

    {{-- Messages de succès --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    {{-- Messages d’erreur --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Solde --}}
    <div class="mb-4">
        <h4>Solde actuel :
            <span class="badge bg-success">
                {{ number_format($portefeuille->solde, 0, ',', ' ') }} FCFA
            </span>
        </h4>
    </div>

    {{-- Formulaire de recharge --}}
    <div class="card shadow-sm border-0 p-4 mb-5" style="max-width: 400px;">
        <h5 class="fw-bold mb-3">Recharger mon portefeuille</h5>
        <form method="POST" action="{{ route('portefeuille.recharger') }}">
            @csrf
            <div class="mb-3">
                <label for="montant" class="form-label">Montant (FCFA)</label>
                <input type="number" name="montant" id="montant" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Recharger</button>
        </form>
    </div>

    {{-- Historique des transactions (optionnel) --}}
    @if(isset($transactions) && $transactions->count() > 0)
        <h5 class="mb-3">Historique des transactions</h5>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($transaction->montant > 0)
                                    <span class="text-success">+{{ number_format($transaction->montant, 0, ',', ' ') }}</span>
                                @else
                                    <span class="text-danger">{{ number_format($transaction->montant, 0, ',', ' ') }}</span>
                                @endif
                                FCFA
                            </td>
                            <td>{{ ucfirst($transaction->type) }}</td>
                            <td>{{ $transaction->description ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Aucune transaction enregistrée pour le moment.</p>
    @endif
</div>
@endsection
