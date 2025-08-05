@extends('layouts.admin')

@section('title', 'Liste des Annonces')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Annonces</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.annonces.index') }}" class="mb-4 d-flex gap-3 align-items-center flex-wrap">
        <select name="statut" class="form-select w-auto">
            <option value="" {{ !$statut ? 'selected' : '' }}>Tous</option>
            <option value="en_attente" {{ $statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
            <option value="validee" {{ $statut === 'validee' ? 'selected' : '' }}>Validée</option>
            <option value="rejetee" {{ $statut === 'rejetee' ? 'selected' : '' }}>Rejetée</option>
        </select>

        <input type="text" name="search" placeholder="Recherche titre ou localisation" value="{{ $search ?? '' }}" class="form-control w-auto" />

        <button type="submit" class="btn btn-primary">Filtrer</button>
        @if($statut || $search)
            <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary">Réinitialiser</a>
        @endif
    </form>

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Propriétaire</th>
                <th>Localisation</th>
                <th>Prix (FCFA)</th>
                <th>Statut</th>
                <th>Soumise le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($annonces as $annonce)
                <tr>
                    <td>{{ $annonce->id }}</td>

                    <td>
                        @if($annonce->image)
                            <img 
                                src="{{ Str::startsWith($annonce->image, 'http') ? $annonce->image : asset('storage/' . $annonce->image) }}" 
                                alt="Image de l'annonce" 
                                style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;"
                            >
                        @else
                            <span class="text-muted">Pas d'image</span>
                        @endif
                    </td>

                    <td>{{ $annonce->titre }}</td>

                    <td>
                        {{ 
                            $annonce->user?->fullname() 
                            ?? $annonce->proprietaire?->user?->fullname() 
                            ?? 'Inconnu' 
                        }}
                    </td>

                    <td>{{ $annonce->localisation }}</td>
                    <td>{{ number_format($annonce->prix, 0, ',', ' ') }}</td>
                    <td>
                        @if($annonce->statut === 'validee')
                            <span class="badge bg-success">Validée</span>
                        @elseif($annonce->statut === 'rejetee')
                            <span class="badge bg-danger">Rejetée</span>
                        @else
                            <span class="badge bg-secondary">En attente</span>
                        @endif
                    </td>
                    <td>{{ $annonce->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.annonces.show', $annonce) }}" class="btn btn-info btn-sm" title="Voir">
                            <i class="bi bi-eye"></i>
                        </a>

                        <form action="{{ route('admin.annonces.destroy', $annonce) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9">Aucune annonce trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $annonces->links() }}
    </div>
</div>
@endsection
