@extends('layouts.admin')

@section('title', 'signalements')

@section('content')
<div class="container">
    <h3 class="mb-4">Signalements reçus</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($signalements->count() > 0)
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Annonce</th>
                    <th>Signalé par</th>
                    <th>Rôle</th>
                    <th>Raison</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($signalements as $signalement)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($signalement->annonce)
                                <a href="{{ route('admin.annonces.show', $signalement->annonce->id) }}">
                                    {{ $signalement->annonce->titre }}
                                </a>
                            @else
                                <em>Annonce supprimée</em>
                            @endif
                        </td>
                        <td>{{ $signalement->utilisateur->name ?? 'Utilisateur supprimé' }}</td>
                        <td>{{ ucfirst($signalement->role_signaleur) }}</td>
                        <td>{{ $signalement->raison }}</td>
                        <td>{{ $signalement->created_at?->format('d/m/Y') ?? 'Date inconnue' }}</td>

                        <td>
                            @if($signalement->statut === 'en_attente')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($signalement->statut === 'traitee')
                                <span class="badge bg-success">Traité</span>
                            @elseif($signalement->statut === 'masquee')
                                <span class="badge bg-secondary">Annonce masquée</span>
                            @elseif($signalement->statut === 'supprimee')
                                <span class="badge bg-danger">Annonce supprimée</span>
                            @endif
                        </td>
                        <td>
                            @if($signalement->statut === 'en_attente')
                                <form action="{{ route('admin.signalements.traiter', $signalement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="action" value="masquer">
                                    <button type="submit" class="btn btn-sm btn-outline-warning">Masquer</button>
                                </form>

                                <form action="{{ route('admin.signalements.traiter', $signalement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="action" value="supprimer">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>

                                <form action="{{ route('admin.signalements.traiter', $signalement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="action" value="clore">
                                    <button type="submit" class="btn btn-sm btn-outline-success">Clore</button>
                                </form>
                            @else
                                <em>Aucune action</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun signalement pour le moment.</p>
    @endif
</div>
@endsection
