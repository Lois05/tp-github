@extends('layouts.admin') {{-- adapte selon ton layout --}}

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Gestion des utilisateurs</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Rechercher par nom, prénom, email..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Rechercher</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Réinitialiser</a>
    </form>

    {{-- Tableau des utilisateurs --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Connecté</th>
                <th>Bloqué</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->prenom }} {{ $user->nom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telephone }}</td>
                <td>
                    @if($activeUserIds->contains($user->id))
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-secondary">Non</span>
                    @endif
                </td>
                <td>
                    @if($user->is_blocked)
                        <span class="badge bg-danger">Oui</span>
                    @else
                        <span class="badge bg-success">Non</span>
                    @endif
                </td>
                <td>
    <div class="btn-group" role="group" aria-label="Actions utilisateur">
        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-info btn-sm" title="Voir le profil">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-warning btn-sm" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir {{ $user->is_blocked ? 'débloquer' : 'bloquer' }} cet utilisateur ?')">
            @csrf
            @method('PATCH')
            <button type="submit"
                class="btn btn-outline-{{ $user->is_blocked ? 'success' : 'danger' }} btn-sm"
                title="{{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}">
                <i class="fas fa-user-{{ $user->is_blocked ? 'check' : 'slash' }}"></i>
            </button>
        </form>
    </div>
</td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Aucun utilisateur trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
