@extends('layouts.admin')

@section('title', 'Gestion des Biens')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Gestion des Biens</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('admin.biens.index') }}" class="row g-2 align-items-center mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou catégorie" value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">
                <i class="fas fa-sync"></i> Réinitialiser
            </a>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('admin.biens.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un Bien
            </a>
        </div>
    </form>

    {{-- Tableau des biens --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($biens as $bien)
                    <tr>
                        <td>{{ $bien->id }}</td>
                        <td>{{ $bien->nom }}</td>
                        <td>{{ $bien->categorie->nom ?? 'Non défini' }}</td>
                        <td>
                            <span class="badge bg-{{ $bien->etat === 'loué' ? 'danger' : 'success' }}">
                                {{ ucfirst($bien->etat) }}
                            </span>
                        </td>
                        <td>{{ $bien->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions bien">
                                <a href="{{ route('admin.biens.show', $bien) }}"
                                   class="btn btn-outline-info btn-sm me-1" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>

                                

                                <form action="{{ route('admin.biens.destroy', $bien) }}" method="POST" class="d-inline me-1" onsubmit="return confirm('Supprimer ce bien ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                {{-- Bouton changer le statut --}}
                                <form action="{{ route('admin.biens.toggleEtat', $bien) }}" method="POST" class="d-inline" onsubmit="return confirm('Changer le statut du bien ?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ $bien->etat === 'loué' ? 'outline-success' : 'outline-warning' }}"
                                        title="Changer le statut">
                                        {{ $bien->etat === 'loué' ? 'Rendre disponible' : 'Marquer comme loué' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun bien trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $biens->withQueryString()->links() }}
    </div>

</div>
@endsection
