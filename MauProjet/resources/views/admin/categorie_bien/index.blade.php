@extends('layouts.admin')

@section('title', 'Liste des catégories')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Liste des Catégories</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.categorie-bien.create') }}" class="btn btn-primary mb-3">Ajouter une Catégorie</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $categorie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $categorie->nom }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($categorie->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.categorie-bien.show', $categorie) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.categorie-bien.edit', $categorie) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.categorie-bien.destroy', $categorie) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune catégorie enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
