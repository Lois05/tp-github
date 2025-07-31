@extends('layouts.client')

@section('title', 'Mes annonces')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Mes annonces</h2>

    @if($annonces->isEmpty())
        <p>Vous n'avez encore publié aucune annonce.</p>
        <a href="{{ route('client.annonce.create') }}" class="btn btn-primary">Publier une annonce</a>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annonces as $annonce)
                    <tr>
                        <td>{{ $annonce->titre }}</td>
                        <td>{{ $annonce->categorie->nom ?? 'Non spécifiée' }}</td>
                        <td>
                            @switch($annonce->statut)
                                @case('en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                    @break
                                @case('valide')
                                    <span class="badge bg-success">Publiée</span>
                                    @break
                                @case('refuse')
                                    <span class="badge bg-danger">Refusée</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ ucfirst($annonce->statut) }}</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('proprietaire.annonces.show', $annonce->id) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('proprietaire.annonces.edit', $annonce->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('proprietaire.annonces.destroy', $annonce->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Confirmer la suppression ?')" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

