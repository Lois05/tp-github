@extends('layouts.admin')

@section('title', 'Détails utilisateur')

@section('content')
<div class="container py-4">
    <h1>Détails de l'utilisateur</h1>

    <div class="card mt-4">
        <div class="card-header">
            <strong>{{ $user->prenom }} {{ $user->nom }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Username :</strong> {{ $user->username }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Téléphone :</strong> {{ $user->telephone }}</p>
            <p><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Statut :</strong>
                @if ($user->is_blocked)
                    <span class="badge bg-danger">Bloqué</span>
                @else
                    <span class="badge bg-success">Actif</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Modifier</a>

        <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            @if ($user->is_blocked)
                <button type="submit" class="btn btn-success">Débloquer</button>
            @else
                <button type="submit" class="btn btn-warning">Bloquer</button>
            @endif
        </form>

        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
