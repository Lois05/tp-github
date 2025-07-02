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
    <h1 class="mb-4">Avis par annonce</h1>

    <!-- FILTRE combiné : statut + recherche -->
    <form method="GET" action="{{ route('admin.avis.index') }}" class="mb-4 d-flex align-items-center gap-3 flex-wrap">
        <label for="filtre" class="form-label mb-0 fw-semibold">Statut :</label>
        <select name="filtre" id="filtre" class="form-select w-auto">
            <option value="" {{ request('filtre') === null ? 'selected' : '' }}>Tous</option>
            <option value="masques" {{ request('filtre') === 'masques' ? 'selected' : '' }}>Masqués</option>
            <option value="affiches" {{ request('filtre') === 'affiches' ? 'selected' : '' }}>Affichés</option>
        </select>

        <label for="search" class="form-label mb-0 fw-semibold">Recherche :</label>
        <input
            type="text"
            name="search"
            id="search"
            class="form-control w-auto"
            placeholder="Utilisateur ou commentaire"
            value="{{ request('search') }}"
        >

        <button type="submit" class="btn btn-primary">Filtrer</button>

        @if(request()->has('filtre') || request()->has('search'))
            <a href="{{ route('admin.avis.index') }}" class="btn btn-secondary">Réinitialiser</a>
        @endif
    </form>

    <!-- LISTE DES AVIS GROUPÉS PAR ANNONCE -->
    @foreach ($annonces as $annonce)
        <div class="card mb-4">
            <div class="card-header">
                <strong>Annonce : {{ $annonce->localisation }}</strong>
                <span class="badge bg-primary ms-2">{{ $annonce->avis_count }} avis</span>
            </div>
            <div class="card-body p-0">
                @if ($annonce->avis->count())
                    <table class="table mb-0 table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Utilisateur</th>
                                <th>Note</th>
                                <th>Commentaire</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonce->avis as $avis)
                                <tr>
                                    <td>{{ $avis->user->nom ?? 'Utilisateur inconnu' }}</td>
                                    <td>{{ $avis->note }}/5</td>
                                    <td>{{ Str::limit($avis->commentaire, 60) }}</td>
                                    <td>
                                        @if ($avis->masque)
                                            <span class="badge bg-danger">Masqué</span>
                                        @else
                                            <span class="badge bg-success">Visible</span>
                                        @endif
                                    </td>
                                    <td>{{ $avis->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.avis.toggle', $avis) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="btn btn-sm {{ $avis->masque ? 'btn-success' : 'btn-warning' }}">
                                                {{ $avis->masque ? 'Afficher' : 'Masquer' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-3">Aucun avis pour cette annonce.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
