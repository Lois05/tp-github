@extends('layouts.client')

@section('title', 'Mes demandes envoyées')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Mes demandes envoyées ({{ $count }})</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($demandes->isEmpty())
        <p class="text-muted">Aucune demande envoyée pour le moment.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Annonce</th>
            <th>Bien</th>
            <th>Propriétaire</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Statut</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach($demandes as $demande)
        <tr>
            <td>{{ $demande->annonce->titre ?? 'Annonce supprimée' }}</td>
            <td>{{ $demande->bien->nom ?? 'Bien supprimé' }}</td>
            <td>
                {{ $demande->proprietaire && $demande->proprietaire->user
                    ? $demande->proprietaire->user->prenom . ' ' . $demande->proprietaire->user->nom
                    : 'Propriétaire supprimé' }}
            </td>
            <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
            <td>
                <span class="badge
                    @if($demande->statut == 'en_attente') bg-warning
                    @elseif($demande->statut == 'accepté') bg-success
                    @elseif($demande->statut == 'refusé') bg-danger
                    @else bg-secondary @endif
                ">
                    {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}
                </span>
            </td>
            <td>{{ $demande->message }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    @endif
</div>
@endsection
