@extends('layouts.admin')

@section('content')
<style>
    table tbody tr:hover {
        background-color: #e1e9e2;
        cursor: pointer;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        transition: opacity 0.2s ease-in-out;
    }
    .btn-sm:hover {
        opacity: 0.8;
    }
</style>

<div class="container py-4">
    <h1 class="mb-4">Annonces en attente de validation</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.annonces.index') }}" class="mb-4 d-flex align-items-center gap-3 flex-wrap">
        <label for="statut" class="form-label mb-0 fw-semibold">Filtrer par statut :</label>
        <select name="statut" id="statut" class="form-select w-auto">
            <option value="" {{ !$statut ? 'selected' : '' }}>Tous</option>
            <option value="en_attente" {{ $statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
            <option value="validee" {{ $statut === 'validee' ? 'selected' : '' }}>Validée</option>
            <option value="rejetee" {{ $statut === 'rejetee' ? 'selected' : '' }}>Rejetée</option>
        </select>

        <label for="search" class="form-label mb-0 fw-semibold">Rechercher :</label>
        <input
            type="text"
            name="search"
            id="search"
            class="form-control w-auto"
            placeholder="Titre ou localisation"
            value="{{ $search ?? '' }}"
        >

        <button type="submit" class="btn btn-primary">Filtrer</button>

        @if($statut || $search)
            <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary">Réinitialiser</a>
        @endif
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Localisation</th>
                    <th>Prix (FCFA)</th>
                    <th>Statut</th>
                    <th>Soumise le</th>
                    <th style="min-width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($annonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>{{ $annonce->titre }}</td>
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
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.annonces.show', $annonce) }}" class="btn btn-sm btn-info" title="Voir"><i class="bi bi-eye"></i></a>

                            @if($annonce->statut === 'en attente')
                                <a href="{{ route('admin.annonces.edit', $annonce) }}" class="btn btn-sm btn-primary" title="Valider / Rejeter"><i class="bi bi-pencil-square"></i></a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">Aucune annonce trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $annonces->links() }}
    </div>
</div>
@endsection
