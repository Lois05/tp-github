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
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Éditer</a>

                    {{-- Formulaire blocage/déblocage --}}
                    <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-{{ $user->is_blocked ? 'success' : 'danger' }} btn-sm"
                            onclick="return confirm('Êtes-vous sûr de vouloir {{ $user->is_blocked ? 'débloquer' : 'bloquer' }} cet utilisateur ?')">
                            {{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}
                        </button>
                    </form>

                    {{-- Formulaire suppression --}}
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                            Supprimer
                        </button>
                    </form>
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
