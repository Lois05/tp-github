@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Liste des Biens</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.bien.create') }}" class="btn btn-primary mb-3">Ajouter un Bien</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($biens as $bien)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $bien->nom }}</td>

                    <td>{{ $bien->categorie->nom ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('admin.bien.show', $bien) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.bien.edit', $bien) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.bien.destroy', $bien) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce bien ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun bien enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
