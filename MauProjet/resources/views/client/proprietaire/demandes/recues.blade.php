@extends('layouts.client')

@section('title', 'Mes demandes reçues')

@section('content')
    <div class="container">
        <h1>Mes demandes reçues</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($demandes->isEmpty())
            <p>Aucune demande reçue pour le moment.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Locataire</th>
                        <th>Annonce</th>
                        <th>Bien</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demandes as $demande)
                        <tr>
                            <td>
                                @if ($demande->locataire && $demande->locataire->user)
                                    {{ $demande->locataire->user->prenom ?? '' }} {{ $demande->locataire->user->nom ?? '' }}
                                @else
                                    Locataire supprimé
                                @endif
                            </td>
                            <td>{{ $demande->annonce->titre ?? 'Annonce supprimée' }}</td>
                            <td>{{ $demande->bien->nom ?? 'Bien supprimé' }}</td>
                            <td>{{ $demande->date_debut->format('d/m/Y') }}</td>
                            <td>{{ $demande->date_fin->format('d/m/Y') }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $demande->statut)) }}</td>
                            <td>{{ $demande->message }}</td>
                            <td>
                                @if ($demande->statut == 'en_attente')
                                    <form action="{{ route('proprietaire.demandes.valider', $demande->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">Accepter</button>
                                    </form>
                                    <form action="{{ route('proprietaire.demandes.refuser', $demande->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Refuser</button>
                                    </form>
                                @else
                                    <em>Demande {{ ucfirst(str_replace('_', ' ', $demande->statut)) }}</em>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
