@extends('layouts.client')

@section('title', 'Mes demandes reçues')

@section('content')
<h2>Mes demandes reçues</h2>

@if($demandesRecues->isEmpty())
    <p>Aucune demande reçue pour le moment.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Locataire</th>
                <th>Annonce</th>
                <th>Dates</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandesRecues as $demande)
            <tr>
                <td>{{ $demande->locataire->nom ?? 'Inconnu' }}</td>
                <td>{{ $demande->annonce->titre }}</td>
                <td>{{ $demande->date_debut }} - {{ $demande->date_fin }}</td>
                <td>{{ $demande->message }}</td>
                <td>{{ ucfirst($demande->statut) }}</td>
                <td>
                    {{-- Boutons valider/refuser --}}
                    <form action="{{ route('proprietaire.demandes.valider', $demande->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Valider</button>
                    </form>
                    <form action="{{ route('proprietaire.demandes.refuser', $demande->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
