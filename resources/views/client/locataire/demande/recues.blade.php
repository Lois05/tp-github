@extends('layouts.client')

@section('title', 'Mes demandes reçues')

@section('content')
<div class="container py-5">
    <h2>Demandes reçues</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($demandesRecues->isEmpty())
        <p>Vous n'avez reçu aucune demande pour l'instant.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Annonce</th>
                    <th>Locataire</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandesRecues as $demande)
                <tr>
                    <td>{{ $demande->annonce->titre ?? '-' }}</td>
                    <td>{{ $demande->locataire->user->name ?? '-' }}</td>
                    <td>{{ $demande->date_debut }}</td>
                    <td>{{ $demande->date_fin }}</td>
                    <td>{{ $demande->message }}</td>
                    <td>{{ ucfirst($demande->statut ?? 'en attente') }}</td>
                    <td>
                        @if($demande->statut === 'en attente')
                        <form action="{{ route('proprietaire.demande.valider', $demande->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Accepter</button>
                        </form>
                        <form action="{{ route('proprietaire.demande.refuser', $demande->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm">Refuser</button>
                        </form>
                        @else
                        {{ ucfirst($demande->statut) }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('client.proprietaire.mes_annonces.index') }}" class="btn btn-primary mt-3">Voir mes annonces</a>
</div>
@endsection
