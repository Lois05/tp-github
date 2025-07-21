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

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Titre</th>
                    <th>Propriétaire</th>
                    <th>Localisation</th>
                    <th>Prix (FCFA)</th>
                    <th>Statut</th>
                    <th>Soumise le</th>
                    <th style="width: 200px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($annonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>{{ $annonce->titre }}</td>
                        <td>{{ $annonce->proprietaire->nom ?? 'N/A' }}</td>
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
                            <div class="btn-group" role="group" aria-label="Actions annonce">
                                @if($annonce->statut === 'en_attente')
                                    <form action="{{ route('admin.annonces.update', $annonce) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="validee">
                                        <button type="submit" class="btn btn-outline-success btn-sm"
                                            onclick="return confirm('Valider cette annonce ?')"
                                            title="Valider">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.annonces.update', $annonce) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="rejetee">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Rejeter cette annonce ?')"
                                            title="Rejeter">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.annonces.show', $annonce) }}" class="btn btn-outline-info btn-sm"
                                        title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Aucune annonce trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $annonces->links() }}
    </div>
</div>
@endsection

