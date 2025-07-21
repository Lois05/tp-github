@extends('layouts.client')

@section('title', 'Mes demandes envoyées')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Mes demandes envoyées</h2>

    @forelse ($demandes as $demande)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <p class="fw-bold mb-2">Annonce : {{ $demande->annonce->titre ?? 'Annonce supprimée' }}</p>
                <p class="mb-1">
                    <strong>Période :</strong> du {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}
                    au {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}
                </p>
                <p class="mb-1"><strong>Message :</strong> {{ $demande->message }}</p>
                <p class="mb-0"><strong>Statut :</strong> {{ ucfirst($demande->statut ?? 'En attente') }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Vous n'avez pas encore envoyé de demandes.
        </div>
    @endforelse
</div>
@endsection

