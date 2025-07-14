@extends('layouts.admin')

@section('title', 'Liste des Catégories')

@section('content')
<div class="container mt-5">

    <h1 class="mb-4 text-dark fw-bold">Liste des Catégories</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.categorie-bien.create') }}" class="btn btn-primary fw-semibold">
            <i class="fas fa-plus me-1"></i> Ajouter une Catégorie
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col" style="width: 25%;">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $categorie)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-semibold">{{ $categorie->nom }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($categorie->description, 60) }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions catégorie">
                                <a href="{{ route('admin.categorie-bien.show', $categorie) }}"
                                   class="btn btn-outline-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.categorie-bien.destroy', $categorie) }}"
                                      method="POST"
                                      onsubmit="return confirm('Confirmer la suppression de cette catégorie ?')"
                                      class="d-inline ms-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center fst-italic text-secondary py-4">Aucune catégorie enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

</div>
@endsection
