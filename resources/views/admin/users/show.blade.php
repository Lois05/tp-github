@extends('layouts.admin')

@section('title', 'Détails utilisateur')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Détails de l'utilisateur</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $user->prenom }} {{ $user->nom }}</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username :</strong> {{ $user->username }}</li>
                <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Téléphone :</strong> {{ $user->telephone }}</li>
                <li class="list-group-item"><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</li>
                <li class="list-group-item"><strong>Dernière mise à jour :</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</li>
                <li class="list-group-item">
                    <strong>Statut :</strong>
                    @if ($user->is_blocked)
                        <span class="badge bg-danger">Bloqué</span>
                    @else
                        <span class="badge bg-success">Actif</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2">
        {{-- Bouton Modifier --}}
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary">
            <i class="fas fa-edit me-1"></i> Modifier
        </a>

        {{-- Blocage / Déblocage --}}
        <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-{{ $user->is_blocked ? 'success' : 'warning' }}">
                <i class="fas fa-user-{{ $user->is_blocked ? 'check' : 'slash' }} me-1"></i>
                {{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}
            </button>
        </form>

        {{-- Suppression (optionnelle) --}}
        {{-- Si tu veux l'enlever, supprime ce bloc --}}
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-trash-alt me-1"></i> Supprimer
            </button>
        </form>

        {{-- Retour --}}
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
